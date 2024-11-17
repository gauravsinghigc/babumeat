<?php
//label
function Label($text, array $attributes)
{ ?>
 <label <?php LOOP_TagsAttributes($attributes); ?>><?php echo $text; ?></label>
<?php }


//function for tags
function tags($tag, $value, array $attibute)
{
?>
 <<?php echo $tag; ?> <?php LOOP_TagsAttributes($attibute); ?>>
  <?php echo $value; ?>
 </<?php echo $tag; ?>>
<?php
}
