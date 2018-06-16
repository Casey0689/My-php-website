<?php
echo "<a href='/blog_all.php'>BACK TO BLOGS</a>";
$form = <<<END_OF_FORM
<H2>CREATE BLOG</H2>
  <form method="POST" action="/blog_create.php">
<label for="title">Title</label>
<input type="text" name="title" value="$title"><span class="error">$title_error</span><br/>
<label for="author">Author</label>
<input type="text" name="author" value="$author"><span class="error">$author_error</span><br/>
<label for="date_posted">Date</label>
<input type="date" name="date_posted" value="$date_posted"><span class="error">$date_posted_error</span><br/>
<label for="blog_text">Blog Text</label>
<input type="text" name="blog_text" value="$blog_text"><span class="error">$text_error</span><br/>

<input type="submit" name="submit" value="Save">
</form>

END_OF_FORM;
echo $form;
?>

