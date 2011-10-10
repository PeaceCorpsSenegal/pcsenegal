<h1>Knowledge Database</h1>
<p>Welcome to the beta version of our new knowledge database. This database will house information to point you in the right direction, no matter what your question. Initially, as we start out, we're starting small with only a few entries, but check it out and see what you think!</p>
<p>So how is what we're doing any different than the resource library and any other part of the site? Below you will find a hierarchical knowledge tree, and attached to subjects will be not only documents and other media, but <em>people</em>. That's right. Next time you're looking for an insect expert or a german translator, come check this out and see if maybe we've already got someone in part of the Peace Corps Senegal greater community who can help you out.</p>
<p>Click on a subject below to see who we've got to help you out.</p>

<div style="width: 600px; margin: 0 auto;">
<div id="tree">
<?php
include('knowledgeTreeClass.inc');
$conn = mysql_connect('p50mysql131.secureserver.net', 'peacecorps', 'PeaceC0rps')
    or die("Impossible to connect : " . mysql_error());
mysql_select_db('peacecorps');

$tree = new knowledge_tree();
echo $tree->printTree('links');

mysql_close($conn);
?>

</div>
</div>