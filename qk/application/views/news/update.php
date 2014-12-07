<h2>Update a news item</h2>
<?php echo validation_errors(); ?>

<?php echo form_open('news/update/'.$news_item['id']) ?>

<input type="hidden" name="flag" value="TRUE" />

<label for="title">Title</label>
<input type="input" name="title" value="<?php echo $news_item['title'] ?>" /><br />

<label for="slug">Slug</label>
<input type="input" name="slug" value="<?php echo $news_item['slug'] ?>" /><br />

<label for="text">Text</label>
<textarea name="text" ><?php echo $news_item['text']  ?></textarea><br />

<input type="submit" name="submit" value="Update news item" />

</form>
