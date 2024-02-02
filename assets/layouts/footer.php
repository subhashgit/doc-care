<footer id="footer" class="footer">
    <div class="copyright">
      © Copyright <strong><span>Doc Care</span></strong>. All Rights Reserved
    </div>
   
  </footer>


<script src="../assets/vendor/js/jquery-3.4.1.min.js"></script>
<script src="../assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../assets/vendors/tinymce/tinymce.min.js"></script>
<script src="../assets/js/main.js"></script>
<script src="../assets/js/app.js"></script>


<?php if(isset($_SESSION['auth'])) { ?> 

<script src="../assets/js/check_inactive.js"></script>
    
<?php } ?>


</body>

</html>

<?php

if (isset($_SESSION['ERRORS']))
    $_SESSION['ERRORS'] = NULL;
if (isset($_SESSION['STATUS']))
    $_SESSION['STATUS'] = NULL;

?>