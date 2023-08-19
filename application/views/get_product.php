<?php
if ($all_data != '') {

    foreach ($all_data as $row) {
        echo '<div class="col">';
        product($row, 'normal');
        echo '</div>';
    }
}
