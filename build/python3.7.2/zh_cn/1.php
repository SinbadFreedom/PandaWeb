<?php
   session_start();
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>熊猫文档-面向程序员的技术文档网站</title>
    <link rel="stylesheet" href="/lib/bootstrap-4.3.1-dist/css/bootstrap.min.css">
    <script src="/lib/google-code-prettify/run_prettify.js"></script>
    <link rel="stylesheet" href="/css/dashidan.css">
</head>
<body>

<div style="background: #2196F3">
    <img src="/img/web_1.png">
</div>

<nav class="navbar navbar-expand navbar-light">
    <div class="container">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link active" href="/index.php"><b>首页</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/php/forum/index.php"><b>笔记</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/php/rank_list.php"><b>排行榜</b></a>
            </li>
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item">
                <?php
                if (isset($_SESSION['figureurl_qq'])) {
                    echo '<a class="nav-link" href="/php/user_info.php"><img class="rounded" src="' . $_SESSION['figureurl_qq'] . '" width="24px" height="24px"></a>';
                } else {
                echo '<a class="nav-link" href="/php/login_ui.php"><b>登录</b></a>';
                }
                ?>
            </li>
        </ul>
    </div>
</nav>

<div class="container">

    <div>
        <a href="/index.php">首页</a>/<a href="catalog.php">&nbsppython3.7.2&nbsp</a>/&nbsp1
    </div>

    <div class="text-right">
        <a href="../zh_cn/1.php"><span>&nbsp简体&nbsp</span></a><a href="../en/1.php"><span>&nbspEnglish&nbsp</span></a>
    </div>

    <hr>

    <h1 id='1.'>1. 激发你的胃口</h1>
<p>如果你在计算机上做了很多工作,最终你会发现有一些你想要自动化的任务.例如,您可能希望对大量文本文件执行搜索和替换,或者以复杂的方式重命名和重新排列一堆照片文件.也许您想编写一个小型自定义数据库,或专门的GUI应用程序,或简单的游戏.</p>
<p>如果您是一名专业的软件开发人员,您可能需要使用多个C / C ++ / Java库,但发现通常的写/编译/测试/重新编译周期太慢.也许您正在为这样的库编写测试套件,并且发现编写测试代码是一项繁琐的工作.或者您可能编写了一个可以使用扩展语言的程序,并且您不希望为您的应用程序设计和实现一种全新的语言.</p>
<p>Python只是你的语言.</p>
<p>您可以为其中一些任务编写Unix shell脚本或Windows批处理文件,但shell脚本最适合移动文件和更改文本数据,不适合GUI应用程序或游戏.您可以编写C / C ++ / Java程序,但是甚至可能需要花费大量的开发时间才能获得初稿程序. Python更易于使用,可在Windows,Mac OS X和Unix操作系统上使用,并可帮助您更快地完成工作.</p>
<p>Python易于使用,但它是一种真正的编程语言,为大型程序提供了比shell脚本或批处理文件更多的结构和支持.另一方面,Python还提供了比C更多的错误检查,并且作为一种非常高级的语言,它具有内置的高级数据类型,例如灵活的数组和字典.由于其更通用的数据类型,Python适用于比Awk甚至Perl更大的问题域,但许多事情在Python中至少与那些语言一样容易.</p>
<p>Python允许您将程序拆分为可在其他Python程序中重用的模块.它附带了大量标准模块,您可以将它们用作程序的基础 - 或者作为开始学习使用Python编程的示例.其中一些模块提供文件I / O,系统调用,套接字,甚至是Tk等图形用户界面工具包的接口.</p>
<p>Python是一种解释型语言,可以在程序开发过程中节省大量时间,因为不需要编译和链接.解释器可以交互使用,这使得在自下而上的程序开发过程中,可以轻松地试验语言的功能,编写丢弃程序或测试功能.它也是一个方便的办公桌计算器.</p>
<p>Python使程序可以紧凑和可读地编写.用Python编写的程序通常比同等的C,C ++或Java程序短得多,原因如下:</p>
<p>高级数据类型允许您在单个语句中表达复杂的操作;
语句分组是通过缩进而不是开头和结尾括号来完成的;
不需要变量或参数声明.
Python是可扩展的:如果您知道如何使用C编程,则很容易向解释器添加新的内置函数或模块,以便以最快的速度执行关键操作,或者将Python程序链接到可能只有可用的库以二进制形式(例如特定于供应商的图形库).一旦你真正上钩,你可以将Python解释器链接到用C编写的应用程序,并将其用作该应用程序的扩展或命令语言.</p>
<p>顺便说一下,这种语言是以BBC节目"Monty Python的飞行马戏团"命名的,与爬行动物无关.不仅允许在文档中引用Monty Python skits,我们鼓励它!</p>
<p>既然您对Python感到兴奋,那么您将需要更详细地研究它.由于学习语言的最佳方法是使用它,因此本教程邀请您在阅读时使用Python解释器.</p>
<p>在下一章中,将解释使用解释器的机制.这是相当普通的信息,但对于尝试后面显示的示例至关重要.</p>
<p>本教程的其余部分通过示例介绍了Python语言和系统的各种功能,从简单的表达式,语句和数据类型开始,通过函数和模块,最后涉及异常和用户定义的类等高级概念.</p>

    <h4>笔记</h4>

    <hr>

    <div id="note_area">
        <!-- 评论区-->
    </div>

    <div>
        <a href="/index.php">&nbsp熊猫文档&nbsp</a>/<a href="catalog.php">&nbsppython3.7.2
        &nbsp</a>/&nbsp1
    </div>

    <div class="text-right">
        当前有<?php echo mt_rand(0, 99); ?>位同学在看此文章
    </div>
</div>

<div class="row center-block text-center">
    <div class="col-6 text-right">
    </div>
    <div class="col-6 text-left">
            <a href="2.php" class="badge badge-primary"> 下一篇 →</a>
    </div>
</div>

<script src="/lib/jquery-3.2.1.min.js"></script>
<script>
    /** 评论*/
    var url = "/php/forum/note_get.php?tag=python3.7.2&contentid=1&show_header=0";
    $.ajax({
        url: url,
        type: "GET",
        async: false,//同步请求用false,异步请求true
        dataType: "html",
        data: {},
        success: function (data) {
            document.getElementById("note_area").innerHTML = data;
        },
        error: function (data, textstatus) {
            //请求不成功返回的提示
        }
    });
</script>
</body>
</html>