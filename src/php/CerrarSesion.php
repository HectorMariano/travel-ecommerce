<?php
// Start the session
    session_start();

    session_unset();
    session_destroy();
    session_abort();
    echo '<META HTTP-EQUIV="REFRESH" CONTENT="0; URL=index.php">';
?>