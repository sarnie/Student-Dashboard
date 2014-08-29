    <script src="js/vendor/jquery-1.10.1.min.js"></script>
    <script src="js/vendor/jquery-ui.js"></script>
    <script src="js/vendor/bootstrap.min.js"></script>

<?php if(getPageType() == 'blog'):?>
    <script src="js/queries.js"></script>
<?php elseif(getPageType() == 'meetings'):?>
    <script src="js/meeting.js"></script>
<?php elseif(getPageType() == 'messages'):?>
    <script src="js/message.js"></script>
<?php elseif(getPageType() == 'uploads'):?>
    <script type="text/javascript" src="js/jquery.form.min.js"></script>
    <script src="js/fileUpload.js"></script>
<?php elseif(getPageType() == 'stats'):?>
    <script type="text/javascript" src="js/stats.js"></script>
<?php endif; ?>
    <script src="js/main.js"></script>
</body>
</html>
