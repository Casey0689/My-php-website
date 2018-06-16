<?php
echo "<a href='/articles_all.php'>BACK TO ARTICLES</a>";
$form = <<<END_OF_FORM
<H2>WRITE A NEW ARTICLE</H2>
<form method="POST" action="/articles_create.php">
<label for="title">Title</label>
<input type="text" name="title" value="$title"><span class="error">$title_error</span><br/>
<label for="author">Author</label>
<input type="text" name="author" value="$author"><span class="error">$author_error</span><br/>
<label for="published_date">Publish Date</label>
<input type="date" name="published_date" value="$published_date"><span class="error">$published_error</span><br/>
<label for="article_text">Article Text</label>
<input type="text" name="article_text" value="$article_text"><span class="error">$text_error</span><br/>

<input type="submit" name="submit" value="Save">
</form>

END_OF_FORM;
echo $form;
?>

