===========================
Pool4Tool Code "Test" v1.2

Last Changed: 11.08.2017
===========================


1.0 Intro:
================

The target of this is to implement a collapsible multilevel TreeView -
(It should look something like this "GenericTreeView.jpg" however check section 5 for more Infos on that).
The point is to get a quick look at general code style/habits/problem solving abilities.
The task is not difficult on purpose so it can be implemented without investing too much time.

- The Data is provided in the db.sql file and should be imported into your mysql DB
- The DB Structure is not optimal on purpose and must not be changed
- Implement your code the best you can (optimized/commented/fast etc.)

Note: In the following text "node" and "entry" are used as synonyms.

1.1 Deadline:
================

Please find the deadline in the original email this file was attached too - in case no deadline was mentioned please notify the original
sender of the email.

Send your solution as an email per instruction below:

Subject: Code Test Result
To: the person who sent you the original mail and
To: christoph.herndler@pool4tool.com

Attachments: lastname_firstname_code_test.zip containing your solution

Try to at least have the ajax modes fully implemented by then. Obviously the best case is having both.

1.2 Questions:
================

If you have any questions feel free to drop me a mail with "Code Test Question" in the subject:
christoph.herndler@pool4tool.com

2.0 DB Structure
================

tree_entry 
* features a list of all the nodes
* if parent_entry_id==0 the node is on the root level, if its anything but 0 the node is under the referred parent entry id.
* entry_ids are not in the order they will appear in the tree and entry_id 16 is missing on purpose

tree_entry_lang
* translation table for the names of the tree nodes
* not all entries exist in both languages - this was done on purpose.

3.0 ToDo/Code
================

1. Create a new mysql database and import the tables and data provided in db.sql
2. Implement the methods from the abstract class in the file/clas myTreeView.class.php
3. We want 2 version of the TreeView :
	A. one that preloads all nodes of the tree when loading the site and only shows/hides the nodes by javascript when collapsing/expanding (so no Ajax)
	B. one that only load/shows the parent_entry_id=0 nodes at first and loads the nodes under it by ajax once the user expands a given node.

A. shall be implemented in showCompleteTree
B. shall be implemented in showAjaxTree
	* The php ajax callback should be implemented in fetchAjaxTreeNode which should receive the entry_id of the node the user clicked on.

4. Implement a button to switch between ajax and the completeTree mode
5. index.php may be altered any way you want. The abstractTreeView.class.php must be used and untouched tho.

Note: Images for the treeview are provided in the images folder

3.1 Required Features:
========================

1. The tree must start out completely collapsed
2. German (ger) translations must be shown, in case a translation doesn't exist show the english one as fallback
3. Expanding/Collapsing nodes of the tree should be done by Javascript -> no page reload
4. Be as efficient as possible - fancy solutions are favored
5. Tree should be sorted/shown with entries in alphabetical order

4. Rules
========================
1. No copy+pasting of complete implementations from the internet.
2. Using Google/Internet is of course allowed tho
3. You may use a JS helper library such as jquery/prototype - but not an already completely done TreeView widget/function/implementation
4. You may use a database abstraction layer such as adodb http://adodb.sourceforge.net/
5. Using a template engine such as smarty is not required, you can use it if you want tho
6. You can optimize things like Unique/Keys/Indexes in the database, but not alter the fields or content of the data.
7. You can create as much files/folders as you want
8. Obviously you are free to create/add as many sub-methods in your class as you want
9. Must run on PHP 5.5
10. Error level must not be changed or hidden and no warnings/error should be produced by your code
11. Do not upload the code test and/or your solution to a public repository

5. Expected Result:
=========================

Tree should start out looking like this:

+ Prio 1 Aufgaben
+ Prio 2 Aufgaben
+ Prio 3 Aufgaben

by clicking on the + icon next to the level the + icon turns into a minus and the entries below it show up, i.e. for Prio 1 Tasks:

- Prio 1 Aufgaben
	+ Supplier
	+ Customer
+ Prio 2 Aufgaben
+ Prio 3 Aufgaben


then, of course by clicking on the + next to the Supplier entry reveals the nodes under it

- Prio 1 Aufgaben
	+ Supplier
		  Punkt ABC123
		+ Punkt BCD123
		  Punkt UARGH123
	+ Customer
+ Prio 2 Aufgaben
+ Prio 3 Aufgaben


and so on. Note how ABC123 and UARGH123 have no more nodes under it therefore no +/- icon (use the blank.gif in the images folder in this case)

