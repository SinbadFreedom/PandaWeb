<!doctype html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>熊猫文档-面向程序员的技术文档网站</title>
    <link rel="stylesheet" href="../../lib/bootstrap-4.3.1-dist/css/bootstrap.min.css">
    <script src="../../lib/google-code-prettify/run_prettify.js"></script>
    <link rel="stylesheet" href="../../css/dashidan.css">
</head>
<body>
<div class="text-right">
    <a href="../zh_cn/4.php"><span>&nbsp简体&nbsp</span></a><a href="../en/4.php"><span>&nbspEnglish&nbsp</span></a>
</div>

<div>
    <a href="../../index.php">&nbsp熊猫文档&nbsp</a>/<a href="catalog.php">&nbsppython3.7.2&nbsp</a>
</div>

<hr>

<h1 id='4.'>4. More Control Flow Tools</h1>
<p>Besides the <a href="#">while</a> statement just introduced, Python knows the usual control flow statements known from other languages, with some twists.</p>
<h3 id="4.1.">4.1. if Statements</h3>
<p>Perhaps the most well-known statement type is the <a href="#">if</a> statement. For example:</p>
<pre class='prettyprint'><code>&gt;&gt;&gt;
&gt;&gt;&gt; x = int(input("Please enter an integer: "))
Please enter an integer: 42
&gt;&gt;&gt; if x &lt; 0:
...     x = 0
...     print('Negative changed to zero')
... elif x == 0:
...     print('Zero')
... elif x == 1:
...     print('Single')
... else:
...     print('More')
...
More
</code></pre>
<p>There can be zero or more <a href="#">elif</a> parts, and the <a href="#">else</a> part is optional. The keyword <code>'elif'</code> is short for <code>'else if'</code>, and is useful to avoid excessive indentation. An if … elif … elif … sequence is a substitute for the <code>switch</code> or <code>case</code> statements found in other languages.</p>
<h3 id="4.2.">4.2. for Statements</h3>
<p>The <a href="#">for</a> statement in Python differs a bit from what you may be used to in C or Pascal. Rather than always iterating over an arithmetic progression of numbers (like in Pascal), or giving the user the ability to define both the iteration step and halting condition (as C), Python's for statement iterates over the items of any sequence (a list or a string), in the order that they appear in the sequence. For example (no pun intended):</p>
<pre class='prettyprint'><code>&gt;&gt;&gt;
&gt;&gt;&gt; # Measure some strings:
... words = ['cat', 'window', 'defenestrate']
&gt;&gt;&gt; for w in words:
...     print(w, len(w))
...
cat 3
window 6
defenestrate 12
</code></pre>
<p>If you need to modify the sequence you are iterating over while inside the loop (for example to duplicate selected items), it is recommended that you first make a copy. Iterating over a sequence does not implicitly make a copy. The slice notation makes this especially convenient:</p>
<pre class='prettyprint'><code>&gt;&gt;&gt;
&gt;&gt;&gt; for w in words[:]:  # Loop over a slice copy of the entire list.
...     if len(w) &gt; 6:
...         words.insert(0, w)
...
&gt;&gt;&gt; words
['defenestrate', 'cat', 'window', 'defenestrate']
</code></pre>
<p>With for w in words:, the example would attempt to create an infinite list, inserting defenestrate over and over again.</p>
<h3 id="4.3.">4.3. The range() Function</h3>
<p>If you do need to iterate over a sequence of numbers, the built-in function <a href="#">range()</a> comes in handy. It generates arithmetic progressions:</p>
<pre class='prettyprint'><code>&gt;&gt;&gt;
&gt;&gt;&gt; for i in range(5):
...     print(i)
...
0
1
2
3
4
</code></pre>
<p>The given end point is never part of the generated sequence; <code>range(10)</code> generates 10 values, the legal indices for items of a sequence of length 10. It is possible to let the range start at another number, or to specify a different increment (even negative; sometimes this is called the 'step'):</p>
<pre class='prettyprint'><code>range(5, 10)
   5, 6, 7, 8, 9

range(0, 10, 3)
   0, 3, 6, 9

range(-10, -100, -30)
  -10, -40, -70
</code></pre>
<p>To iterate over the indices of a sequence, you can combine <a href="#">range()</a> and <a href="#">len()</a> as follows:</p>
<pre class='prettyprint'><code>&gt;&gt;&gt;
&gt;&gt;&gt; a = ['Mary', 'had', 'a', 'little', 'lamb']
&gt;&gt;&gt; for i in range(len(a)):
...     print(i, a[i])
...
0 Mary
1 had
2 a
3 little
4 lamb
</code></pre>
<p>In most such cases, however, it is convenient to use the <a href="#">enumerate()</a> function, see <a href="#">Looping Techniques</a>.</p>
<p>A strange thing happens if you just print a range:</p>
<pre class='prettyprint'><code>&gt;&gt;&gt;
&gt;&gt;&gt; print(range(10))
range(0, 10)
</code></pre>
<p>In many ways the object returned by <a href="#">range()</a> behaves as if it is a list, but in fact it isn't. It is an object which returns the successive items of the desired sequence when you iterate over it, but it doesn't really make the list, thus saving space.</p>
<p>We say such an object is iterable, that is, suitable as a target for functions and constructs that expect something from which they can obtain successive items until the supply is exhausted. We have seen that the <a href="#">for</a> statement is such an iterator. The function <a href="#">list()</a> is another; it creates lists from iterables:</p>
<pre class='prettyprint'><code>&gt;&gt;&gt;
&gt;&gt;&gt; list(range(5))
[0, 1, 2, 3, 4]
</code></pre>
<p>Later we will see more functions that return iterables and take iterables as argument.</p>
<h3 id="4.4.">4.4. break and continue Statements, and else Clauses on Loops</h3>
<p>The <a href="#">break</a> statement, like in C, breaks out of the innermost enclosing <a href="#">for</a> or <a href="#">while</a> loop.</p>
<p>Loop statements may have an else clause; it is executed when the loop terminates through exhaustion of the list (with <a href="#">for</a>) or when the condition becomes false (with <a href="#">while</a>), but not when the loop is terminated by a <a href="#">break</a> statement. This is exemplified by the following loop, which searches for prime numbers:</p>
<pre class='prettyprint'><code>&gt;&gt;&gt;
&gt;&gt;&gt; for n in range(2, 10):
...     for x in range(2, n):
...         if n % x == 0:
...             print(n, 'equals', x, '*', n//x)
...             break
...     else:
...         # loop fell through without finding a factor
...         print(n, 'is a prime number')
...
2 is a prime number
3 is a prime number
4 equals 2 * 2
5 is a prime number
6 equals 2 * 3
7 is a prime number
8 equals 2 * 4
9 equals 3 * 3
</code></pre>
<p>(Yes, this is the correct code. Look closely: the <code>else</code> clause belongs to the <a href="#">for</a> loop, not the <a href="#">if</a> statement.)</p>
<p>When used with a loop, the <code>else</code> clause has more in common with the <code>else</code> clause of a <a href="#">try</a> statement than it does that of <a href="#">if</a> statements: a try statement's <a href="#">else</a> clause runs when no exception occurs, and a loop's <code>else</code> clause runs when no <code>break</code> occurs. For more on the <code>try</code> statement and exceptions, see <a href="#">Handling Exceptions</a>.</p>
<p>The <a href="#">continue</a> statement, also borrowed from C, continues with the next iteration of the loop:</p>
<pre class='prettyprint'><code>&gt;&gt;&gt;
&gt;&gt;&gt; for num in range(2, 10):
...     if num % 2 == 0:
...         print("Found an even number", num)
...         continue
...     print("Found a number", num)
Found an even number 2
Found a number 3
Found an even number 4
Found a number 5
Found an even number 6
Found a number 7
Found an even number 8
Found a number 9
</code></pre>
<h3 id="4.5.">4.5. pass Statements</h3>
<p>The <a href="#">pass</a> statement does nothing. It can be used when a statement is required syntactically but the program requires no action. For example:</p>
<pre class='prettyprint'><code>&gt;&gt;&gt;
&gt;&gt;&gt; while True:
...     pass  # Busy-wait for keyboard interrupt (Ctrl+C)
...
</code></pre>
<p>This is commonly used for creating minimal classes:</p>
<pre class='prettyprint'><code>&gt;&gt;&gt;
&gt;&gt;&gt; class MyEmptyClass:
...     pass
...
</code></pre>
<p>Another place <a href="#">pass</a> can be used is as a place-holder for a function or conditional body when you are working on new code, allowing you to keep thinking at a more abstract level. The pass is silently ignored:</p>
<pre class='prettyprint'><code>&gt;&gt;&gt;
&gt;&gt;&gt; def initlog(*args):
...     pass   # Remember to implement this!
...
</code></pre>
<h3 id="4.6.">4.6. Defining Functions</h3>
<p>We can create a function that writes the Fibonacci series to an arbitrary boundary:</p>
<pre class='prettyprint'><code>&gt;&gt;&gt;
&gt;&gt;&gt; def fib(n):    # write Fibonacci series up to n
...     """Print a Fibonacci series up to n."""
...     a, b = 0, 1
...     while a &lt; n:
...         print(a, end=' ')
...         a, b = b, a+b
...     print()
...
&gt;&gt;&gt; # Now call the function we just defined:
... fib(2000)
0 1 1 2 3 5 8 13 21 34 55 89 144 233 377 610 987 1597
</code></pre>
<p>The keyword <a href="#">def</a> introduces a function definition. It must be followed by the function name and the parenthesized list of formal parameters. The statements that form the body of the function start at the next line, and must be indented.</p>
<p>The first statement of the function body can optionally be a string literal; this string literal is the function's documentation string, or docstring. (More about docstrings can be found in the section <a href="#">Documentation Strings</a>.) There are tools which use docstrings to automatically produce online or printed documentation, or to let the user interactively browse through code; it's good practice to include docstrings in code that you write, so make a habit of it.</p>
<p>The execution of a function introduces a new symbol table used for the local variables of the function. More precisely, all variable assignments in a function store the value in the local symbol table; whereas variable references first look in the local symbol table, then in the local symbol tables of enclosing functions, then in the global symbol table, and finally in the table of built-in names. Thus, global variables cannot be directly assigned a value within a function (unless named in a <a href="#">global</a> statement), although they may be referenced.</p>
<p>The actual parameters (arguments) to a function call are introduced in the local symbol table of the called function when it is called; thus, arguments are passed using call by value (where the value is always an object reference, not the value of the object). <a href="#">1</a> When a function calls another function, a new local symbol table is created for that call.</p>
<p>A function definition introduces the function name in the current symbol table. The value of the function name has a type that is recognized by the interpreter as a user-defined function. This value can be assigned to another name which can then also be used as a function. This serves as a general renaming mechanism:</p>
<pre class='prettyprint'><code>&gt;&gt;&gt;
&gt;&gt;&gt; fib
&lt;function fib at 10042ed0&gt;
&gt;&gt;&gt; f = fib
&gt;&gt;&gt; f(100)
0 1 1 2 3 5 8 13 21 34 55 89
</code></pre>
<p>Coming from other languages, you might object that <code>fib</code> is not a function but a procedure since it doesn't return a value. In fact, even functions without a <a href="#">return</a> statement do return a value, albeit a rather boring one. This value is called <code>None</code> (it's a built-in name). Writing the value <code>None</code> is normally suppressed by the interpreter if it would be the only value written. You can see it if you really want to using <a href="#">print()</a>:</p>
<pre class='prettyprint'><code>&gt;&gt;&gt;
&gt;&gt;&gt; fib(0)
&gt;&gt;&gt; print(fib(0))
None
</code></pre>
<p>It is simple to write a function that returns a list of the numbers of the Fibonacci series, instead of printing it:</p>
<pre class='prettyprint'><code>&gt;&gt;&gt;
&gt;&gt;&gt; def fib2(n):  # return Fibonacci series up to n
...     """Return a list containing the Fibonacci series up to n."""
...     result = []
...     a, b = 0, 1
...     while a &lt; n:
...         result.append(a)    # see below
...         a, b = b, a+b
...     return result
...
&gt;&gt;&gt; f100 = fib2(100)    # call it
&gt;&gt;&gt; f100                # write the result
[0, 1, 1, 2, 3, 5, 8, 13, 21, 34, 55, 89]
</code></pre>
<p>This example, as usual, demonstrates some new Python features:</p>
<ul>
<li><p>The <a href="#">return</a> statement returns with a value from a function. <code>return</code> without an expression argument returns <code>None</code>. Falling off the end of a function also returns <code>None</code>.</p></li>
<li><p>The statement <code>result.append(a)</code> calls a method of the list object <code>result</code>. A method is a function that 'belongs' to an object and is named <code>obj.methodname</code>, where <code>obj</code> is some object (this may be an expression), and <code>methodname</code> is the name of a method that is defined by the object's type. Different types define different methods. Methods of different types may have the same name without causing ambiguity. (It is possible to define your own object types and methods, using classes, see <a href="#">Classes</a>) The method <code>append()</code> shown in the example is defined for list objects; it adds a new element at the end of the list. In this example it is equivalent to <code>result = result + [a]</code>, but more efficient.</p></li>
</ul>
<h3 id="4.7.">4.7. More on Defining Functions</h3>
<p>It is also possible to define functions with a variable number of arguments. There are three forms, which can be combined.</p>
<h4 id="4.7.1.">4.7.1. Default Argument Values</h4>
<p>The most useful form is to specify a default value for one or more arguments. This creates a function that can be called with fewer arguments than it is defined to allow. For example:</p>
<pre class='prettyprint'><code>def ask_ok(prompt, retries=4, reminder='Please try again!'):
    while True:
        ok = input(prompt)
        if ok in ('y', 'ye', 'yes'):
            return True
        if ok in ('n', 'no', 'nop', 'nope'):
            return False
        retries = retries - 1
        if retries &lt; 0:
            raise ValueError('invalid user response')
        print(reminder)
</code></pre>
<p>This function can be called in several ways:</p>
<ul>
<li><p>giving only the mandatory argument: <code>ask_ok('Do you really want to quit?')</code></p></li>
<li><p>giving one of the optional arguments: <code>ask_ok('OK to overwrite the file?', 2)</code></p></li>
<li><p>or even giving all arguments: <code>ask_ok('OK to overwrite the file?', 2, 'Come on, only yes or no!')</code></p></li>
</ul>
<p>This example also introduces the <a href="#">in</a> keyword. This tests whether or not a sequence contains a certain value.</p>
<p>The default values are evaluated at the point of function definition in the defining scope, so that</p>
<pre class='prettyprint'><code>i = 5

def f(arg=i):
    print(arg)

i = 6
f()
</code></pre>
<p>will print <code>5</code>.</p>
<p>Important warning: The default value is evaluated only once. This makes a difference when the default is a mutable object such as a list, dictionary, or instances of most classes. For example, the following function accumulates the arguments passed to it on subsequent calls:</p>
<pre class='prettyprint'><code>def f(a, L=[]):
    L.append(a)
    return L

print(f(1))
print(f(2))
print(f(3))
This will print

[1]
[1, 2]
[1, 2, 3]
</code></pre>
<p>If you don't want the default to be shared between subsequent calls, you can write the function like this instead:</p>
<pre class='prettyprint'><code>def f(a, L=None):
    if L is None:
        L = []
    L.append(a)
    return L
</code></pre>
<h4 id="4.7.2.">4.7.2. Keyword Arguments</h4>
<p>Functions can also be called using <a href="#">keyword arguments</a> of the form <code>kwarg=value</code>. For instance, the following function:</p>
<pre class='prettyprint'><code>def parrot(voltage, state='a stiff', action='voom', type='Norwegian Blue'):
    print("-- This parrot wouldn't", action, end=' ')
    print("if you put", voltage, "volts through it.")
    print("-- Lovely plumage, the", type)
    print("-- It's", state, "!")
</code></pre>
<p>accepts one required argument (<code>voltage</code>) and three optional arguments (<code>state</code>, <code>action</code>, and <code>type</code>). This function can be called in any of the following ways:</p>
<pre class='prettyprint'><code>parrot(1000)                                          # 1 positional argument
parrot(voltage=1000)                                  # 1 keyword argument
parrot(voltage=1000000, action='VOOOOOM')             # 2 keyword arguments
parrot(action='VOOOOOM', voltage=1000000)             # 2 keyword arguments
parrot('a million', 'bereft of life', 'jump')         # 3 positional arguments
parrot('a thousand', state='pushing up the daisies')  # 1 positional, 1 keyword
</code></pre>
<p>but all the following calls would be invalid:</p>
<pre class='prettyprint'><code>parrot()                     # required argument missing
parrot(voltage=5.0, 'dead')  # non-keyword argument after a keyword argument
parrot(110, voltage=220)     # duplicate value for the same argument
parrot(actor='John Cleese')  # unknown keyword argument
</code></pre>
<p>In a function call, keyword arguments must follow positional arguments. All the keyword arguments passed must match one of the arguments accepted by the function (e.g. <code>actor</code> is not a valid argument for the <code>parrot</code> function), and their order is not important. This also includes non-optional arguments (e.g. <code>parrot(voltage=1000)</code> is valid too). No argument may receive a value more than once. Here's an example that fails due to this restriction:</p>
<pre class='prettyprint'><code>&gt;&gt;&gt;
&gt;&gt;&gt; def function(a):
...     pass
...
&gt;&gt;&gt; function(0, a=0)
Traceback (most recent call last):
  File "&lt;stdin&gt;", line 1, in &lt;module&gt;
TypeError: function() got multiple values for keyword argument 'a'
</code></pre>
<p>When a final formal parameter of the form <code>**name</code> is present, it receives a dictionary (see <a href="#">Mapping Types - dict</a>) containing all keyword arguments except for those corresponding to a formal parameter. This may be combined with a formal parameter of the form <code>*name</code> (described in the next subsection) which receives a tuple containing the positional arguments beyond the formal parameter list. (<code>*name</code> must occur before <code>**name</code>.) For example, if we define a function like this:</p>
<pre class='prettyprint'><code>def cheeseshop(kind, *arguments, **keywords):
    print("-- Do you have any", kind, "?")
    print("-- I'm sorry, we're all out of", kind)
    for arg in arguments:
        print(arg)
    print("-" * 40)
    for kw in keywords:
        print(kw, ":", keywords[kw])
</code></pre>
<p>It could be called like this:</p>
<pre class='prettyprint'><code>cheeseshop("Limburger", "It's very runny, sir.",
           "It's really very, VERY runny, sir.",
           shopkeeper="Michael Palin",
           client="John Cleese",
           sketch="Cheese Shop Sketch")
</code></pre>
<p>and of course it would print:</p>
<pre class='prettyprint'><code>-- Do you have any Limburger ?
-- I'm sorry, we're all out of Limburger
It's very runny, sir.
It's really very, VERY runny, sir.
----------------------------------------
shopkeeper : Michael Palin
client : John Cleese
sketch : Cheese Shop Sketch
</code></pre>
<p>Note that the order in which the keyword arguments are printed is guaranteed to match the order in which they were provided in the function call.</p>
<h4 id="4.7.3.">4.7.3. Arbitrary Argument Lists</h4>
<p>Finally, the least frequently used option is to specify that a function can be called with an arbitrary number of arguments. These arguments will be wrapped up in a tuple (see <a href="#">Tuples and Sequences</a>). Before the variable number of arguments, zero or more normal arguments may occur.</p>
<pre class='prettyprint'><code>def write_multiple_items(file, separator, *args):
    file.write(separator.join(args))
</code></pre>
<p>Normally, these <code>variadic</code> arguments will be last in the list of formal parameters, because they scoop up all remaining input arguments that are passed to the function. Any formal parameters which occur after the <code>*args</code> parameter are 'keyword-only' arguments, meaning that they can only be used as keywords rather than positional arguments.</p>
<pre class='prettyprint'><code>&gt;&gt;&gt;
&gt;&gt;&gt; def concat(*args, sep="/"):
...     return sep.join(args)
...
&gt;&gt;&gt; concat("earth", "mars", "venus")
'earth/mars/venus'
&gt;&gt;&gt; concat("earth", "mars", "venus", sep=".")
'earth.mars.venus'
</code></pre>
<h4 id="4.7.4.">4.7.4. Unpacking Argument Lists</h4>
<p>The reverse situation occurs when the arguments are already in a list or tuple but need to be unpacked for a function call requiring separate positional arguments. For instance, the built-in <a href="#">range()</a> function expects separate start and stop arguments. If they are not available separately, write the function call with the <code>*</code>-operator to unpack the arguments out of a list or tuple:</p>
<pre class='prettyprint'><code>&gt;&gt;&gt;
&gt;&gt;&gt; list(range(3, 6))            # normal call with separate arguments
[3, 4, 5]
&gt;&gt;&gt; args = [3, 6]
&gt;&gt;&gt; list(range(*args))            # call with arguments unpacked from a list
[3, 4, 5]
</code></pre>
<p>In the same fashion, dictionaries can deliver keyword arguments with the <code>**</code>-operator:</p>
<pre class='prettyprint'><code>&gt;&gt;&gt;
&gt;&gt;&gt; def parrot(voltage, state='a stiff', action='voom'):
...     print("-- This parrot wouldn't", action, end=' ')
...     print("if you put", voltage, "volts through it.", end=' ')
...     print("E's", state, "!")
...
&gt;&gt;&gt; d = {"voltage": "four million", "state": "bleedin' demised", "action": "VOOM"}
&gt;&gt;&gt; parrot(**d)
-- This parrot wouldn't VOOM if you put four million volts through it. E's bleedin' demised !
</code></pre>
<h4 id="4.7.5.">4.7.5. Lambda Expressions</h4>
<p>Small anonymous functions can be created with the <a href="#">lambda</a> keyword. This function returns the sum of its two arguments: <code>lambda a, b: a+b</code>. Lambda functions can be used wherever function objects are required. They are syntactically restricted to a single expression. Semantically, they are just syntactic sugar for a normal function definition. Like nested function definitions, lambda functions can reference variables from the containing scope:</p>
<pre class='prettyprint'><code>&gt;&gt;&gt;
&gt;&gt;&gt; def make_incrementor(n):
...     return lambda x: x + n
...
&gt;&gt;&gt; f = make_incrementor(42)
&gt;&gt;&gt; f(0)
42
&gt;&gt;&gt; f(1)
43
</code></pre>
<p>The above example uses a lambda expression to return a function. Another use is to pass a small function as an argument:</p>
<pre class='prettyprint'><code>&gt;&gt;&gt;
&gt;&gt;&gt; pairs = [(1, 'one'), (2, 'two'), (3, 'three'), (4, 'four')]
&gt;&gt;&gt; pairs.sort(key=lambda pair: pair[1])
&gt;&gt;&gt; pairs
[(4, 'four'), (1, 'one'), (3, 'three'), (2, 'two')]
</code></pre>
<h4 id="4.7.6.">4.7.6. Documentation Strings</h4>
<p>Here are some conventions about the content and formatting of documentation strings.</p>
<p>The first line should always be a short, concise summary of the object's purpose. For brevity, it should not explicitly state the object's name or type, since these are available by other means (except if the name happens to be a verb describing a function's operation). This line should begin with a capital letter and end with a period.</p>
<p>If there are more lines in the documentation string, the second line should be blank, visually separating the summary from the rest of the description. The following lines should be one or more paragraphs describing the object's calling conventions, its side effects, etc.</p>
<p>The Python parser does not strip indentation from multi-line string literals in Python, so tools that process documentation have to strip indentation if desired. This is done using the following convention. The first non-blank line after the first line of the string determines the amount of indentation for the entire documentation string. (We can't use the first line since it is generally adjacent to the string's opening quotes so its indentation is not apparent in the string literal.) Whitespace "equivalent" to this indentation is then stripped from the start of all lines of the string. Lines that are indented less should not occur, but if they occur all their leading whitespace should be stripped. Equivalence of whitespace should be tested after expansion of tabs (to 8 spaces, normally).</p>
<p>Here is an example of a multi-line docstring:</p>
<pre class='prettyprint'><code>&gt;&gt;&gt;
&gt;&gt;&gt; def my_function():
...     """Do nothing, but document it.
...
...     No, really, it doesn't do anything.
...     """
...     pass
...
&gt;&gt;&gt; print(my_function.__doc__)
Do nothing, but document it.

    No, really, it doesn't do anything.
</code></pre>
<h4 id="4.7.7.">4.7.7. Function Annotations</h4>
<p><a href="#">Function annotations</a> are completely optional metadata information about the types used by user-defined functions (see <a href="#">PEP 3107</a> and <a href="#">PEP 484</a> for more information).</p>
<p><a href="#">Annotations</a> are stored in the <code>__annotations__</code> attribute of the function as a dictionary and have no effect on any other part of the function. Parameter annotations are defined by a colon after the parameter name, followed by an expression evaluating to the value of the annotation. Return annotations are defined by a literal <code>-&gt;</code>, followed by an expression, between the parameter list and the colon denoting the end of the <a href="#">def</a> statement. The following example has a positional argument, a keyword argument, and the return value annotated:</p>
<pre class='prettyprint'><code>&gt;&gt;&gt;
&gt;&gt;&gt; def f(ham: str, eggs: str = 'eggs') -&gt; str:
...     print("Annotations:", f.__annotations__)
...     print("Arguments:", ham, eggs)
...     return ham + ' and ' + eggs
...
&gt;&gt;&gt; f('spam')
Annotations: {'ham': &lt;class 'str'&gt;, 'return': &lt;class 'str'&gt;, 'eggs': &lt;class 'str'&gt;}
Arguments: spam eggs
'spam and eggs'
</code></pre>
<h3 id="4.8.">4.8. Intermezzo: Coding Style</h3>
<p>Now that you are about to write longer, more complex pieces of Python, it is a good time to talk about coding style. Most languages can be written (or more concise, formatted) in different styles; some are more readable than others. Making it easy for others to read your code is always a good idea, and adopting a nice coding style helps tremendously for that.</p>
<p>For Python, <a href="#">PEP 8</a> has emerged as the style guide that most projects adhere to; it promotes a very readable and eye-pleasing coding style. Every Python developer should read it at some point; here are the most important points extracted for you:</p>
<ul>
<li>Use 4-space indentation, and no tabs.</li>
</ul>
<p>4 spaces are a good compromise between small indentation (allows greater nesting depth) and large indentation (easier to read). Tabs introduce confusion, and are best left out.</p>
<ul>
<li>Wrap lines so that they don't exceed 79 characters.</li>
</ul>
<p>This helps users with small displays and makes it possible to have several code files side-by-side on larger displays.</p>
<ul>
<li>Use blank lines to separate functions and classes, and larger blocks of code inside functions.</li>
</ul>
<p>When possible, put comments on a line of their own.</p>
<ul>
<li><p>Use docstrings.</p></li>
<li><p>Use spaces around operators and after commas, but not directly inside bracketing constructs: <code>a = f(1, 2) + g(3, 4)</code>.</p></li>
<li><p>Name your classes and functions consistently; the convention is to use <code>CamelCase</code> for classes and <code>lower_case_with_underscores</code> for functions and methods. Always use self as the name for the first method argument (see <a href="#">A First Look at Classes</a> for more on classes and methods).</p></li>
<li><p>Don't use fancy encodings if your code is meant to be used in international environments. Python's default, UTF-8, or even plain ASCII work best in any case.</p></li>
<li><p>Likewise, don't use non-ASCII characters in identifiers if there is only the slightest chance people speaking a different language will read or maintain the code.</p></li>
</ul>
<p><em>Footnotes</em></p>
<p><a href="#">1</a>    Actually, call by object reference would be a better description, since if a mutable object is passed, the caller will see any changes the callee makes to it (items inserted into a list).</p>


<h4>最新笔记</h4>

<hr>

<div id="note_area">
<!-- 评论区-->
</div>

<textarea style="width: 100%" placeholder="点击添加笔记" rows="6"></textarea>
<button type="button" class="btn btn-primary">提交</button>

<div class="text-right">
    当前有<?php echo mt_rand(0, 99); ?>位同学在看此文章
</div>

<div class="row center-block text-center">
    <div class="col-6">
            <a href="3.php" class="badge badge-primary text-center">← 上一篇</a>
            </div>
    <div class="col-6">
            <a href="5.php" class="badge badge-primary"> 下一篇 →</a>
    </div>
</div>

<script src="../../lib/jquery-3.2.1.min.js"></script>
<script>
    /** 评论*/
    var url = "../../php/forum/content_get.php?tag=python3.7.2&contentid=4";
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