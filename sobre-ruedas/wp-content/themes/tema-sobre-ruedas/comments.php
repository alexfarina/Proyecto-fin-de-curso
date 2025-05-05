<?php
printf("<div class='template-comments'>");
    comment_form();

    printf('<ol>');
    wp_list_comments();
    printf('</ol>');

printf("</div>");
?>
