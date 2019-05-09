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
        <a href="/index.php">首页</a>/<a href="catalog.php">&nbsppython3.7.2&nbsp</a>/&nbsp5
    </div>

    <div class="text-right">
        <a href="../zh_cn/5.php"><span>&nbsp简体&nbsp</span></a><a href="../en/5.php"><span>&nbspEnglish&nbsp</span></a>
    </div>

    <hr>

    <h1 id='5.'>5. Data Structures</h1>
<p>This chapter describes some things you've learned about already in more detail, and adds some new things as well.</p>
<h3 id="5.1.">5.1. More on Lists</h3>
<p>The list data type has some more methods. Here are all of the methods of list objects:</p>
<ul>
<li><p>list.<em>append(x)</em></p>
<p>Add an item to the end of the list. Equivalent to <code>a[len(a):] = [x]</code>.</p></li>
<li><p>list.<em>extend(iterable)</em></p>
<p>Extend the list by appending all the items from the iterable. Equivalent to <code>a[len(a):] = iterable</code>.</p></li>
<li><p>list.<em>insert(i, x)</em></p>
<p>Insert an item at a given position. The first argument is the index of the element before which to insert, so <code>a.insert(0, x)</code> inserts at the front of the list, and <code>a.insert(len(a), x)</code> is equivalent to <code>a.append(x)</code>.</p></li>
<li><p>list.<em>remove(x)</em></p>
<p>Remove the first item from the list whose value is equal to x. It raises a <a href="#">ValueError</a> if there is no such item.</p></li>
<li><p>list.<em>pop([i])</em></p>
<p>Remove the item at the given position in the list, and return it. If no index is specified, <code>a.pop()</code> removes and returns the last item in the list. (The square brackets around the i in the method signature denote that the parameter is optional, not that you should type square brackets at that position. You will see this notation frequently in the Python Library Reference.)</p></li>
<li><p>list.<em>clear()</em></p>
<p>Remove all items from the list. Equivalent to <code>del a[:]</code>.</p></li>
<li><p>list.<em>index(x[, start[, end]])</em></p>
<p>Return zero-based index in the list of the first item whose value is equal to x. Raises a <a href="#">ValueError</a> if there is no such item.</p>
<p>The optional arguments start and end are interpreted as in the slice notation and are used to limit the search to a particular subsequence of the list. The returned index is computed relative to the beginning of the full sequence rather than the start argument.</p></li>
<li><p>list.<em>count(x)</em></p>
<p>Return the number of times x appears in the list.</p></li>
<li><p>list.<em>sort(key=None, reverse=False)</em></p>
<p>Sort the items of the list in place (the arguments can be used for sort customization, see <a href="#">sorted()</a> for their explanation).</p></li>
<li><p>list.<em>reverse()</em></p>
<p>Reverse the elements of the list in place.</p></li>
<li><p>list.<em>copy()</em></p>
<p>Return a shallow copy of the list. Equivalent to <code>a[:]</code>.</p>
<p>An example that uses most of the list methods:</p></li>
</ul>
<pre class='prettyprint'><code>&gt;&gt;&gt;
&gt;&gt;&gt; fruits = ['orange', 'apple', 'pear', 'banana', 'kiwi', 'apple', 'banana']
&gt;&gt;&gt; fruits.count('apple')
2
&gt;&gt;&gt; fruits.count('tangerine')
0
&gt;&gt;&gt; fruits.index('banana')
3
&gt;&gt;&gt; fruits.index('banana', 4)  # Find next banana starting a position 4
6
&gt;&gt;&gt; fruits.reverse()
&gt;&gt;&gt; fruits
['banana', 'apple', 'kiwi', 'banana', 'pear', 'apple', 'orange']
&gt;&gt;&gt; fruits.append('grape')
&gt;&gt;&gt; fruits
['banana', 'apple', 'kiwi', 'banana', 'pear', 'apple', 'orange', 'grape']
&gt;&gt;&gt; fruits.sort()
&gt;&gt;&gt; fruits
['apple', 'apple', 'banana', 'banana', 'grape', 'kiwi', 'orange', 'pear']
&gt;&gt;&gt; fruits.pop()
'pear'
</code></pre>
<p>You might have noticed that methods like <code>insert</code>, <code>remove</code> or <code>sort</code> that only modify the list have no return value printed – they return the default <code>None</code>. <a href="#">1</a> This is a design principle for all mutable data structures in Python.</p>
<h4 id="5.1.1.">5.1.1. Using Lists as Stacks</h4>
<p>The list methods make it very easy to use a list as a stack, where the last element added is the first element retrieved ("last-in, first-out"). To add an item to the top of the stack, use <code>append()</code>. To retrieve an item from the top of the stack, use <code>pop()</code> without an explicit index. For example:</p>
<pre class='prettyprint'><code>&gt;&gt;&gt;
&gt;&gt;&gt; stack = [3, 4, 5]
&gt;&gt;&gt; stack.append(6)
&gt;&gt;&gt; stack.append(7)
&gt;&gt;&gt; stack
[3, 4, 5, 6, 7]
&gt;&gt;&gt; stack.pop()
7
&gt;&gt;&gt; stack
[3, 4, 5, 6]
&gt;&gt;&gt; stack.pop()
6
&gt;&gt;&gt; stack.pop()
5
&gt;&gt;&gt; stack
[3, 4]
</code></pre>
<h4 id="5.1.2.">5.1.2. Using Lists as Queues</h4>
<p>It is also possible to use a list as a queue, where the first element added is the first element retrieved ("first-in, first-out"); however, lists are not efficient for this purpose. While appends and pops from the end of list are fast, doing inserts or pops from the beginning of a list is slow (because all of the other elements have to be shifted by one).</p>
<p>To implement a queue, use <a href="#">collections.deque</a> which was designed to have fast appends and pops from both ends. For example:</p>
<pre class='prettyprint'><code>&gt;&gt;&gt;
&gt;&gt;&gt; from collections import deque
&gt;&gt;&gt; queue = deque(["Eric", "John", "Michael"])
&gt;&gt;&gt; queue.append("Terry")           # Terry arrives
&gt;&gt;&gt; queue.append("Graham")          # Graham arrives
&gt;&gt;&gt; queue.popleft()                 # The first to arrive now leaves
'Eric'
&gt;&gt;&gt; queue.popleft()                 # The second to arrive now leaves
'John'
&gt;&gt;&gt; queue                           # Remaining queue in order of arrival
deque(['Michael', 'Terry', 'Graham'])
</code></pre>
<h4 id="5.1.3.">5.1.3. List Comprehensions</h4>
<p>List comprehensions provide a concise way to create lists. Common applications are to make new lists where each element is the result of some operations applied to each member of another sequence or iterable, or to create a subsequence of those elements that satisfy a certain condition.</p>
<p>For example, assume we want to create a list of squares, like:</p>
<pre class='prettyprint'><code>&gt;&gt;&gt;
&gt;&gt;&gt; squares = []
&gt;&gt;&gt; for x in range(10):
...     squares.append(x**2)
...
&gt;&gt;&gt; squares
[0, 1, 4, 9, 16, 25, 36, 49, 64, 81]
</code></pre>
<p>Note that this creates (or overwrites) a variable named x that still exists after the loop completes. We can calculate the list of squares without any side effects using:</p>
<pre class='prettyprint'><code>squares = list(map(lambda x: x**2, range(10)))
</code></pre>
<p>or, equivalently:</p>
<pre class='prettyprint'><code>squares = [x**2 for x in range(10)]
</code></pre>
<p>which is more concise and readable.</p>
<p>A list comprehension consists of brackets containing an expression followed by a for clause, then zero or more for or if clauses. The result will be a new list resulting from evaluating the expression in the context of the for and if clauses which follow it. For example, this listcomp combines the elements of two lists if they are not equal:</p>
<pre class='prettyprint'><code>&gt;&gt;&gt;
&gt;&gt;&gt; [(x, y) for x in [1,2,3] for y in [3,1,4] if x != y]
[(1, 3), (1, 4), (2, 3), (2, 1), (2, 4), (3, 1), (3, 4)]
and it's equivalent to:

&gt;&gt;&gt;
&gt;&gt;&gt; combs = []
&gt;&gt;&gt; for x in [1,2,3]:
...     for y in [3,1,4]:
...         if x != y:
...             combs.append((x, y))
...
&gt;&gt;&gt; combs
[(1, 3), (1, 4), (2, 3), (2, 1), (2, 4), (3, 1), (3, 4)]
</code></pre>
<p>Note how the order of the <a href="#">for</a> and <a href="#">if</a> statements is the same in both these snippets.</p>
<p>If the expression is a tuple (e.g. the (<code>x, y</code>) in the previous example), it must be parenthesized.</p>
<pre class='prettyprint'><code>&gt;&gt;&gt;
&gt;&gt;&gt; vec = [-4, -2, 0, 2, 4]
&gt;&gt;&gt; # create a new list with the values doubled
&gt;&gt;&gt; [x*2 for x in vec]
[-8, -4, 0, 4, 8]
&gt;&gt;&gt; # filter the list to exclude negative numbers
&gt;&gt;&gt; [x for x in vec if x &gt;= 0]
[0, 2, 4]
&gt;&gt;&gt; # apply a function to all the elements
&gt;&gt;&gt; [abs(x) for x in vec]
[4, 2, 0, 2, 4]
&gt;&gt;&gt; # call a method on each element
&gt;&gt;&gt; freshfruit = ['  banana', '  loganberry ', 'passion fruit  ']
&gt;&gt;&gt; [weapon.strip() for weapon in freshfruit]
['banana', 'loganberry', 'passion fruit']
&gt;&gt;&gt; # create a list of 2-tuples like (number, square)
&gt;&gt;&gt; [(x, x**2) for x in range(6)]
[(0, 0), (1, 1), (2, 4), (3, 9), (4, 16), (5, 25)]
&gt;&gt;&gt; # the tuple must be parenthesized, otherwise an error is raised
&gt;&gt;&gt; [x, x**2 for x in range(6)]
  File "&lt;stdin&gt;", line 1, in &lt;module&gt;
    [x, x**2 for x in range(6)]
               ^
SyntaxError: invalid syntax
&gt;&gt;&gt; # flatten a list using a listcomp with two 'for'
&gt;&gt;&gt; vec = [[1,2,3], [4,5,6], [7,8,9]]
&gt;&gt;&gt; [num for elem in vec for num in elem]
[1, 2, 3, 4, 5, 6, 7, 8, 9]
</code></pre>
<p>List comprehensions can contain complex expressions and nested functions:</p>
<pre class='prettyprint'><code>&gt;&gt;&gt;
&gt;&gt;&gt; from math import pi
&gt;&gt;&gt; [str(round(pi, i)) for i in range(1, 6)]
['3.1', '3.14', '3.142', '3.1416', '3.14159']
</code></pre>
<h4 id="5.1.4.">5.1.4. Nested List Comprehensions</h4>
<p>The initial expression in a list comprehension can be any arbitrary expression, including another list comprehension.</p>
<p>Consider the following example of a 3x4 matrix implemented as a list of 3 lists of length 4:</p>
<pre class='prettyprint'><code>&gt;&gt;&gt;
&gt;&gt;&gt; matrix = [
...     [1, 2, 3, 4],
...     [5, 6, 7, 8],
...     [9, 10, 11, 12],
... ]
</code></pre>
<p>The following list comprehension will transpose rows and columns:</p>
<pre class='prettyprint'><code>&gt;&gt;&gt;
&gt;&gt;&gt; [[row[i] for row in matrix] for i in range(4)]
[[1, 5, 9], [2, 6, 10], [3, 7, 11], [4, 8, 12]]
</code></pre>
<p>As we saw in the previous section, the nested listcomp is evaluated in the context of the <a href="#">for</a> that follows it, so this example is equivalent to:</p>
<pre class='prettyprint'><code>&gt;&gt;&gt;
&gt;&gt;&gt; transposed = []
&gt;&gt;&gt; for i in range(4):
...     transposed.append([row[i] for row in matrix])
...
&gt;&gt;&gt; transposed
[[1, 5, 9], [2, 6, 10], [3, 7, 11], [4, 8, 12]]
</code></pre>
<p>which, in turn, is the same as:</p>
<pre class='prettyprint'><code>&gt;&gt;&gt;
&gt;&gt;&gt; transposed = []
&gt;&gt;&gt; for i in range(4):
...     # the following 3 lines implement the nested listcomp
...     transposed_row = []
...     for row in matrix:
...         transposed_row.append(row[i])
...     transposed.append(transposed_row)
...
&gt;&gt;&gt; transposed
[[1, 5, 9], [2, 6, 10], [3, 7, 11], [4, 8, 12]]
</code></pre>
<p>In the real world, you should prefer built-in functions to complex flow statements. The <a href="#">zip()</a> function would do a great job for this use case:</p>
<pre class='prettyprint'><code>&gt;&gt;&gt;
&gt;&gt;&gt; list(zip(*matrix))
[(1, 5, 9), (2, 6, 10), (3, 7, 11), (4, 8, 12)]
</code></pre>
<p>See Unpacking Argument Lists for details on the asterisk in this line.</p>
<h4 id="5.2.">5.2. The del statement</h4>
<p>There is a way to remove an item from a list given its index instead of its value: the <a href="#">del</a> statement. This differs from the <code>pop()</code> method which returns a value. The del statement can also be used to remove slices from a list or clear the entire list (which we did earlier by assignment of an empty list to the slice). For example:</p>
<pre class='prettyprint'><code>&gt;&gt;&gt;
&gt;&gt;&gt; a = [-1, 1, 66.25, 333, 333, 1234.5]
&gt;&gt;&gt; del a[0]
&gt;&gt;&gt; a
[1, 66.25, 333, 333, 1234.5]
&gt;&gt;&gt; del a[2:4]
&gt;&gt;&gt; a
[1, 66.25, 1234.5]
&gt;&gt;&gt; del a[:]
&gt;&gt;&gt; a
[]
</code></pre>
<p><a href="#">del</a> can also be used to delete entire variables:</p>
<pre class='prettyprint'><code>&gt;&gt;&gt;
&gt;&gt;&gt; del a
</code></pre>
<p>Referencing the name a hereafter is an error (at least until another value is assigned to it). We'll find other uses for del later.</p>
<h4 id="5.3.">5.3. Tuples and Sequences</h4>
<p>We saw that lists and strings have many common properties, such as indexing and slicing operations. They are two examples of sequence data types (see <a href="#">Sequence Types - list, tuple, range</a>). Since Python is an evolving language, other sequence data types may be added. There is also another standard sequence data type: the <code>tuple</code>.</p>
<p>A tuple consists of a number of values separated by commas, for instance:</p>
<pre class='prettyprint'><code>&gt;&gt;&gt;
&gt;&gt;&gt; t = 12345, 54321, 'hello!'
&gt;&gt;&gt; t[0]
12345
&gt;&gt;&gt; t
(12345, 54321, 'hello!')
&gt;&gt;&gt; # Tuples may be nested:
... u = t, (1, 2, 3, 4, 5)
&gt;&gt;&gt; u
((12345, 54321, 'hello!'), (1, 2, 3, 4, 5))
&gt;&gt;&gt; # Tuples are immutable:
... t[0] = 88888
Traceback (most recent call last):
  File "&lt;stdin&gt;", line 1, in &lt;module&gt;
TypeError: 'tuple' object does not support item assignment
&gt;&gt;&gt; # but they can contain mutable objects:
... v = ([1, 2, 3], [3, 2, 1])
&gt;&gt;&gt; v
([1, 2, 3], [3, 2, 1])
</code></pre>
<p>As you see, on output tuples are always enclosed in parentheses, so that nested tuples are interpreted correctly; they may be input with or without surrounding parentheses, although often parentheses are necessary anyway (if the tuple is part of a larger expression). It is not possible to assign to the individual items of a tuple, however it is possible to create tuples which contain mutable objects, such as lists.</p>
<p>Though tuples may seem similar to lists, they are often used in different situations and for different purposes. Tuples are <a href="#">immutable</a>, and usually contain a heterogeneous sequence of elements that are accessed via unpacking (see later in this section) or indexing (or even by attribute in the case of <a href="#">namedtuples</a>). Lists are <a href="#">mutable</a>, and their elements are usually homogeneous and are accessed by iterating over the list.</p>
<p>A special problem is the construction of tuples containing 0 or 1 items: the syntax has some extra quirks to accommodate these. Empty tuples are constructed by an empty pair of parentheses; a tuple with one item is constructed by following a value with a comma (it is not sufficient to enclose a single value in parentheses). Ugly, but effective. For example:</p>
<pre class='prettyprint'><code>&gt;&gt;&gt;
&gt;&gt;&gt; empty = ()
&gt;&gt;&gt; singleton = 'hello',    # &lt;-- note trailing comma
&gt;&gt;&gt; len(empty)
0
&gt;&gt;&gt; len(singleton)
1
&gt;&gt;&gt; singleton
('hello',)
</code></pre>
<p>The statement <code>t = 12345, 54321, 'hello!'</code> is an example of tuple packing: the values <code>12345</code>, <code>54321</code> and <code>'hello!'</code> are packed together in a tuple. The reverse operation is also possible:</p>
<pre class='prettyprint'><code>&gt;&gt;&gt;
&gt;&gt;&gt; x, y, z = t
</code></pre>
<p>This is called, appropriately enough, sequence unpacking and works for any sequence on the right-hand side. Sequence unpacking requires that there are as many variables on the left side of the equals sign as there are elements in the sequence. Note that multiple assignment is really just a combination of tuple packing and sequence unpacking.</p>
<h4 id="5.4.">5.4. Sets</h4>
<p>Python also includes a data type for sets. A set is an unordered collection with no duplicate elements. Basic uses include membership testing and eliminating duplicate entries. Set objects also support mathematical operations like union, intersection, difference, and symmetric difference.</p>
<p>Curly braces or the <a href="#">set()</a> function can be used to create sets. Note: to create an empty set you have to use <a href="#">set()</a>, not <code>{}</code>; the latter creates an empty dictionary, a data structure that we discuss in the next section.</p>
<p>Here is a brief demonstration:</p>
<pre class='prettyprint'><code>&gt;&gt;&gt;
&gt;&gt;&gt; basket = {'apple', 'orange', 'apple', 'pear', 'orange', 'banana'}
&gt;&gt;&gt; print(basket)                      # show that duplicates have been removed
{'orange', 'banana', 'pear', 'apple'}
&gt;&gt;&gt; 'orange' in basket                 # fast membership testing
True
&gt;&gt;&gt; 'crabgrass' in basket
False

&gt;&gt;&gt; # Demonstrate set operations on unique letters from two words
...
&gt;&gt;&gt; a = set('abracadabra')
&gt;&gt;&gt; b = set('alacazam')
&gt;&gt;&gt; a                                  # unique letters in a
{'a', 'r', 'b', 'c', 'd'}
&gt;&gt;&gt; a - b                              # letters in a but not in b
{'r', 'd', 'b'}
&gt;&gt;&gt; a | b                              # letters in a or b or both
{'a', 'c', 'r', 'd', 'b', 'm', 'z', 'l'}
&gt;&gt;&gt; a &amp; b                              # letters in both a and b
{'a', 'c'}
&gt;&gt;&gt; a ^ b                              # letters in a or b but not both
{'r', 'd', 'b', 'm', 'z', 'l'}
</code></pre>
<p>Similarly to <a href="#">list comprehensions</a>, set comprehensions are also supported:</p>
<pre class='prettyprint'><code>&gt;&gt;&gt;
&gt;&gt;&gt; a = {x for x in 'abracadabra' if x not in 'abc'}
&gt;&gt;&gt; a
{'r', 'd'}
</code></pre>
<h3 id="5.5.">5.5. Dictionaries</h3>
<p>Another useful data type built into Python is the dictionary (see <a href="#">Mapping Types - dict</a>). Dictionaries are sometimes found in other languages as "associative memories" or "associative arrays". Unlike sequences, which are indexed by a range of numbers, dictionaries are indexed by keys, which can be any immutable type; strings and numbers can always be keys. Tuples can be used as keys if they contain only strings, numbers, or tuples; if a tuple contains any mutable object either directly or indirectly, it cannot be used as a key. You can't use lists as keys, since lists can be modified in place using index assignments, slice assignments, or methods like <code>append()</code> and <code>extend()</code>.</p>
<p>It is best to think of a dictionary as a set of key: value pairs, with the requirement that the keys are unique (within one dictionary). A pair of braces creates an empty dictionary: <code>{}</code>. Placing a comma-separated list of key:value pairs within the braces adds initial key:value pairs to the dictionary; this is also the way dictionaries are written on output.</p>
<p>The main operations on a dictionary are storing a value with some key and extracting the value given the key. It is also possible to delete a key:value pair with del. If you store using a key that is already in use, the old value associated with that key is forgotten. It is an error to extract a value using a non-existent key.</p>
<p>Performing <code>list(d)</code> on a dictionary returns a list of all the keys used in the dictionary, in insertion order (if you want it sorted, just use <code>sorted(d)</code> instead). To check whether a single key is in the dictionary, use the <code>in</code> keyword.</p>
<p>Here is a small example using a dictionary:</p>
<pre class='prettyprint'><code>&gt;&gt;&gt;
&gt;&gt;&gt; tel = {'jack': 4098, 'sape': 4139}
&gt;&gt;&gt; tel['guido'] = 4127
&gt;&gt;&gt; tel
{'jack': 4098, 'sape': 4139, 'guido': 4127}
&gt;&gt;&gt; tel['jack']
4098
&gt;&gt;&gt; del tel['sape']
&gt;&gt;&gt; tel['irv'] = 4127
&gt;&gt;&gt; tel
{'jack': 4098, 'guido': 4127, 'irv': 4127}
&gt;&gt;&gt; list(tel)
['jack', 'guido', 'irv']
&gt;&gt;&gt; sorted(tel)
['guido', 'irv', 'jack']
&gt;&gt;&gt; 'guido' in tel
True
&gt;&gt;&gt; 'jack' not in tel
False
</code></pre>
<p>The <a href="#">dict()</a> constructor builds dictionaries directly from sequences of key-value pairs:</p>
<pre class='prettyprint'><code>&gt;&gt;&gt;
&gt;&gt;&gt; dict([('sape', 4139), ('guido', 4127), ('jack', 4098)])
{'sape': 4139, 'guido': 4127, 'jack': 4098}
</code></pre>
<p>In addition, dict comprehensions can be used to create dictionaries from arbitrary key and value expressions:</p>
<pre class='prettyprint'><code>&gt;&gt;&gt;
&gt;&gt;&gt; {x: x**2 for x in (2, 4, 6)}
{2: 4, 4: 16, 6: 36}
</code></pre>
<p>When the keys are simple strings, it is sometimes easier to specify pairs using keyword arguments:</p>
<pre class='prettyprint'><code>&gt;&gt;&gt;
&gt;&gt;&gt; dict(sape=4139, guido=4127, jack=4098)
{'sape': 4139, 'guido': 4127, 'jack': 4098}
</code></pre>
<h3 id="5.6.">5.6. Looping Techniques</h3>
<p>When looping through dictionaries, the key and corresponding value can be retrieved at the same time using the items() method.</p>
<pre class='prettyprint'><code>&gt;&gt;&gt;
&gt;&gt;&gt; knights = {'gallahad': 'the pure', 'robin': 'the brave'}
&gt;&gt;&gt; for k, v in knights.items():
...     print(k, v)
...
gallahad the pure
robin the brave
</code></pre>
<p>When looping through a sequence, the position index and corresponding value can be retrieved at the same time using the <a href="#">enumerate()</a> function.</p>
<pre class='prettyprint'><code>&gt;&gt;&gt;
&gt;&gt;&gt; for i, v in enumerate(['tic', 'tac', 'toe']):
...     print(i, v)
...
0 tic
1 tac
2 toe
</code></pre>
<p>To loop over two or more sequences at the same time, the entries can be paired with the <a href="#">zip()</a> function.</p>
<pre class='prettyprint'><code>&gt;&gt;&gt;
&gt;&gt;&gt; questions = ['name', 'quest', 'favorite color']
&gt;&gt;&gt; answers = ['lancelot', 'the holy grail', 'blue']
&gt;&gt;&gt; for q, a in zip(questions, answers):
...     print('What is your {0}?  It is {1}.'.format(q, a))
...
What is your name?  It is lancelot.
What is your quest?  It is the holy grail.
What is your favorite color?  It is blue.
</code></pre>
<p>To loop over a sequence in reverse, first specify the sequence in a forward direction and then call the <a href="#">reversed()</a> function.</p>
<pre class='prettyprint'><code>&gt;&gt;&gt;
&gt;&gt;&gt; for i in reversed(range(1, 10, 2)):
...     print(i)
...
9
7
5
3
1
</code></pre>
<p>To loop over a sequence in sorted order, use the <a href="#">sorted()</a> function which returns a new sorted list while leaving the source unaltered.</p>
<pre class='prettyprint'><code>&gt;&gt;&gt;
&gt;&gt;&gt; basket = ['apple', 'orange', 'apple', 'pear', 'orange', 'banana']
&gt;&gt;&gt; for f in sorted(set(basket)):
...     print(f)
...
apple
banana
orange
pear
</code></pre>
<p>It is sometimes tempting to change a list while you are looping over it; however, it is often simpler and safer to create a new list instead.</p>
<pre class='prettyprint'><code>&gt;&gt;&gt;
&gt;&gt;&gt; import math
&gt;&gt;&gt; raw_data = [56.2, float('NaN'), 51.7, 55.3, 52.5, float('NaN'), 47.8]
&gt;&gt;&gt; filtered_data = []
&gt;&gt;&gt; for value in raw_data:
...     if not math.isnan(value):
...         filtered_data.append(value)
...
&gt;&gt;&gt; filtered_data
[56.2, 51.7, 55.3, 52.5, 47.8]
</code></pre>
<h3 id="5.7.">5.7. More on Conditions</h3>
<p>The conditions used in <code>while</code> and <code>if</code> statements can contain any operators, not just comparisons.</p>
<p>The comparison operators <code>in</code> and <code>not in</code> check whether a value occurs (does not occur) in a sequence. The operators <code>is</code> and <code>is not</code> compare whether two objects are really the same object; this only matters for mutable objects like lists. All comparison operators have the same priority, which is lower than that of all numerical operators.</p>
<p>Comparisons can be chained. For example, <code>a &lt; b == c</code> tests whether <code>a</code> is less than <code>b</code> and moreover <code>b</code> equals <code>c</code>.</p>
<p>Comparisons may be combined using the Boolean operators <code>and</code> and <code>or</code>, and the outcome of a comparison (or of any other Boolean expression) may be negated with <code>not</code>. These have lower priorities than comparison operators; between them, <code>not</code> has the highest priority and or the lowest, so that <code>A and not B or C</code> is equivalent to <code>(A and (not B)) or C</code> As always, parentheses can be used to express the desired composition.</p>
<p>The Boolean operators <code>and</code> and <code>or</code> are so-called short-circuit operators: their arguments are evaluated from left to right, and evaluation stops as soon as the outcome is determined. For example, if <code>A</code> and <code>C</code> are <code>true</code> but <code>B</code> is <code>false</code>, <code>A and B and C</code> does not evaluate the expression <code>C</code>. When used as a general value and not as a Boolean, the return value of a short-circuit operator is the last evaluated argument.</p>
<p>It is possible to assign the result of a comparison or other Boolean expression to a variable. For example,</p>
<pre class='prettyprint'><code>&gt;&gt;&gt;
&gt;&gt;&gt; string1, string2, string3 = '', 'Trondheim', 'Hammer Dance'
&gt;&gt;&gt; non_null = string1 or string2 or string3
&gt;&gt;&gt; non_null
'Trondheim'
</code></pre>
<p>Note that in Python, unlike C, assignment cannot occur inside expressions. C programmers may grumble about this, but it avoids a common class of problems encountered in C programs: typing <code>=</code> in an expression when <code>==</code> was intended.</p>
<h3 id="5.8.">5.8. Comparing Sequences and Other Types</h3>
<p>Sequence objects may be compared to other objects with the same sequence type. The comparison uses lexicographical ordering: first the first two items are compared, and if they differ this determines the outcome of the comparison; if they are equal, the next two items are compared, and so on, until either sequence is exhausted. If two items to be compared are themselves sequences of the same type, the lexicographical comparison is carried out recursively. If all items of two sequences compare equal, the sequences are considered equal. If one sequence is an initial sub-sequence of the other, the shorter sequence is the smaller (lesser) one. Lexicographical ordering for strings uses the Unicode code point number to order individual characters. Some examples of comparisons between sequences of the same type:</p>
<pre class='prettyprint'><code>(1, 2, 3)              &lt; (1, 2, 4)
[1, 2, 3]              &lt; [1, 2, 4]
'ABC' &lt; 'C' &lt; 'Pascal' &lt; 'Python'
(1, 2, 3, 4)           &lt; (1, 2, 4)
(1, 2)                 &lt; (1, 2, -1)
(1, 2, 3)             == (1.0, 2.0, 3.0)
(1, 2, ('aa', 'ab'))   &lt; (1, 2, ('abc', 'a'), 4)
</code></pre>
<p>Note that comparing objects of different types with <code>&lt;</code> or <code>&gt;</code> is legal provided that the objects have appropriate comparison methods. For example, mixed numeric types are compared according to their numeric value, so 0 equals 0.0, etc. Otherwise, rather than providing an arbitrary ordering, the interpreter will raise a <a href="#">TypeError</a> exception.</p>
<p><em>Footnotes</em></p>
<p><a href="#">1</a>    Other languages may return the mutated object, which allows method chaining, such as <code>d-&gt;insert("a")-&gt;remove("b")-&gt;sort()</code>;.</p>

    <h4>笔记</h4>

    <hr>

    <div id="note_area">
        <!-- 评论区-->
    </div>

    <div>
        <a href="/index.php">&nbsp熊猫文档&nbsp</a>/<a href="catalog.php">&nbsppython3.7.2
        &nbsp</a>/&nbsp5
    </div>

    <div class="text-right">
        当前有<?php echo mt_rand(0, 99); ?>位同学在看此文章
    </div>
</div>

<div class="row center-block text-center">
    <div class="col-6 text-right">
            <a href="4.php" class="badge badge-primary">← 上一篇</a>
            </div>
    <div class="col-6 text-left">
            <a href="6.php" class="badge badge-primary"> 下一篇 →</a>
    </div>
</div>

<script src="/lib/jquery-3.2.1.min.js"></script>
<script>
    /** 评论*/
    var url = "/php/forum/note_get.php?tag=python3.7.2&contentid=5&show_header=0";
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