"use strict";
const fs = require('fs');
const showdown = require('showdown');
const Handlebars = require("handlebars");

const article_type = process.argv[2];
const article_folder = "../md/" + article_type;

/** pc默认格式文件目录*/
let htmlOutBaseFolder = "../build/" + article_type;
/** handlebars 模板文件*/
let handlebars_template_file_name = article_folder + "/template.handlebars";
/** 全部md文件名*/
let allFileName = [];

function getAllMdFileName(folderName) {
    console.log("readFolder folderName : " + folderName);
    let files = fs.readdirSync(folderName);
    files.forEach(function (file) {
        if (file.endsWith('.md')) {
            let isNumber = isFileStartWithNumber(file);
            if (isNumber) {
                /** 只获取已经添加数字的文件,这个数字是从1开始的*/
                console.log(" sub_file: " + file);
                allFileName.push(file);
            }
        }
    });
    console.log("allFileName: " + allFileName);
}

/**
 * 输出文件名采用数字
 * 移除后缀名
 * 文件名必修以"数字"+"."开始, 否则会错
 */
function isFileStartWithNumber(fileName) {
    const fileNumber = fileName.split('.')[0];
    let intFileNumber = parseInt(fileNumber);
    if (intFileNumber) {
        /** 首字母是数字*/
        return true;
    } else {
        /** 首字母不是数字, 忽略该文件*/
        return false;
    }
}

/**
 * 读取目录中的MD文件
 * @param folderName
 */
function convertAllFile() {
    /** 检测输出目录，不存在则创建*/
    let exist = fs.existsSync(htmlOutBaseFolder);
    if (!exist) {
        fs.mkdirSync(htmlOutBaseFolder);
    }

    /** 转化md文件*/
    for (let index in allFileName) {
        let mdFileNameWithFolder = article_folder + "/" + allFileName[index];
        let outHtmlFileName = htmlOutBaseFolder + "/" + allFileName[index].replace('.md', '.html');
        convertSingleFile(mdFileNameWithFolder, outHtmlFileName);
    }
}

/**
 * 匹配一级标题 ===, 修改id，以空格为拆分，前边的作为 h1 的id
 */
showdown.extension('custom-header-id-for-title-1', function () {
    var setextRegexH1 = /^(.+)[ \t]*\n=+[ \t]*\n+/gm;

    return [{
        type: 'listener',
        listeners: {
            'headers.before': function (event, text, converter, options, globals) {
                text = text.replace(setextRegexH1, function (wholeMatch, m1) {
                    var spanGamut = showdown.subParser('spanGamut')(m1, options, globals),
                        hLevel    = 1,
                        hID       = " id='" + m1.split(" ")[0] + "'",
                        hashBlock = '<h' + hLevel + hID + '>' + spanGamut + '</h' + hLevel + '>';
                    return showdown.subParser('hashBlock')(hashBlock, options, globals);
                });
                return text;
            }
        }
    }];
});

/**
 * 匹配二级标题 ---, 修改id，以空格为拆分，前边的作为 h2 的id
 */
showdown.extension('custom-header-id-for-title-2', function () {
    var setextRegexH2 = /^(.+)[ \t]*\n-+[ \t]*\n+/gm;

    return [{
        type: 'listener',
        listeners: {
            'headers.before': function (event, text, converter, options, globals) {
                text = text.replace(setextRegexH2, function (wholeMatch, m1) {
                    var spanGamut = showdown.subParser('spanGamut')(m1, options, globals),
                        hLevel    = 2,
                        hID       = " id='" + m1.split(" ")[0] + "'",
                        hashBlock = '<h' + hLevel + hID + '>' + spanGamut + '</h' + hLevel + '>';
                    return showdown.subParser('hashBlock')(hashBlock, options, globals);
                });
                return text;
            }
        }
    }];
});


/**
 *  加入自定义插件改变标题id规则 只对以"#"开头的标题生效(#,##,###...######),
 *  "==="及"---"对应的标题id 采用上边的两个方法。
 *
 *  插件参考：
 *  https://jsfiddle.net/tivie/107yuueg/
 *
 */
showdown.extension('custom-header-id', function () {
    // var rgx = /^(#{1,6})[ \t]*(.+?) *\{: *#([\S]+?)\}[ \t]*#*$/gmi;
    /** 匹配标题*/
    var rgx = /^(#{1,6})[ \t]*(.+?) *[ \t]*#*$/gmi;

    return [{
        type: 'listener',
        listeners: {
            'headers.before': function (event, text, converter, options, globals) {
                text = text.replace(rgx, function (wm, hLevel, hText, hCustomId) {
                    // find how many # there are at the beggining of the header
                    // these will define the header level
                    hLevel = hLevel.length;

                    // since headers can have markdown in them (ex: # some *italic* header)
                    // we need to pass the text to the span parser
                    hText = showdown.subParser('spanGamut')(hText, options, globals);

                    // console.error("hText " + hText + " hCustomId " + hCustomId)
                    /**
                     * id规则为标题字符串以空格符拆分，前边的字符串。
                     * 比如:
                     * 2.2.1. 源代码编码
                     * id 为 2.2.1
                     */
                    let titleId = hText.split(" ")[0];


                    // create the appropriate HTML
                    var header = '<h' + hLevel + ' id="' + titleId + '">' + hText + '</h' + hLevel + '>';

                    // hash block to prevent any further modification
                    return showdown.subParser('hashBlock')(header, options, globals);
                });
                // return the changed text
                return text;
            }
        }
    }];
});

/**
 * Mardown文件转化为html文件
 * @param mdFile
 * @param outHtmlFile
 */
function convertSingleFile(mdFileNameWithFolder, outHtmlFile) {
    const mdData = fs.readFileSync(mdFileNameWithFolder, 'utf-8');
    // let converter = new showdown.Converter();
    /**
     * 加入自定义插件 改变生成标题id的规则，
     * 一级标题 ===， 二级标题 ---， 其他标题(#,##...######), 三种情况区分，用3个插件分别对应
     */
    var converter = new showdown.Converter({extensions: ['custom-header-id', 'custom-header-id-for-title-1', 'custom-header-id-for-title-2']});

    let htmlData = converter.makeHtml(mdData);
    /** 不转化index.md, 采用单独的模板, 这里只转化文章内容*/
    console.log("-------------------------------------------------------");
    console.log("convertFile " + mdFileNameWithFolder + " to: " + outHtmlFile);
    console.log("-------------------------------------------------------");
    /** 配置表中加入其它参数*/
    let article_config = {};
    article_config.content = htmlData;
    /**  读取handlebars模板数据 默认pc文件 读取template_article.hbs*/
    let mustache_data = fs.readFileSync(handlebars_template_file_name, 'utf-8');
    /** 转化为html数据*/
    const compiled = Handlebars.compile(mustache_data);
    let finalData = compiled(article_config);
    /** <code> 标签加上 google-code-pretty class, 使用正则表达式全部替换，不用正则的话，只替一个 */
    finalData = finalData.replace(/<pre>/g, "<pre class='prettyprint'>");
    /** 写入文件*/
    fs.writeFileSync(outHtmlFile, finalData);
    console.log("convertFile OK.");
}


/** 获取所有目录下所有数字开头的md文件*/
getAllMdFileName(article_folder);
/** 转化全部文件*/
convertAllFile();