<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <!-- TemplateBeginEditable name="doctitle" -->
  <title>Site's Template</title>
  <!-- TemplateEndEditable -->
  <!-- TemplateBeginEditable name="head" -->
  <!-- TemplateEndEditable --> 
<link href="../styles/styles.css" rel="stylesheet" type="text/css"><!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>

<body>

  <div class="container">
    <header>
      <a href="#">
		<div id="Banner">hfgyjhgj</div>
      </a>  
    </header>

	<div class="navigation">
		<nav>
			<ul id="topMenu"> 
				<li><a href="index.php">Trang chủ</a></li>
				<li><a href="register.php">Đăng ký</a></li>
				<li><a href="login.php">Đăng nhập</a></li>
				<li><a href="contact.php">Liên hệ</a></li>
				<li><a href="map.php">Phân trang</a></li>
				<li><a href="search.php">Tìm kiếm</a></li>
			</ul>
		</nav>
	</div>
	
     
      <div class="sidebar1">
        <nav>
          <ul id="ulLeftMenu">
			<script language="javascript">
				function showLeftMenu() {
					var xhttp = new XMLHttpRequest();
					xhttp.onreadystatechange = function() {
						if (xhttp.readyState == 4 && xhttp.status == 200) {
							xmlDoc = xhttp.responseXML;
							
							htmlOptions = "";
							menuoptions = xmlDoc.getElementsByTagName("Name");
							for (i = 0; i < menuoptions.length; i++) {
								htmlOptions += "<li><a href='" + xmlDoc.getElementsByTagName("Link")[i].firstChild.nodeValue + "'>" + xmlDoc.getElementsByTagName("Name")[i].firstChild.nodeValue + "</a></li>";
							}
							
							document.getElementById("ulLeftMenu").innerHTML = htmlOptions;
						}
					}
					
					xhttp.open("GET", "leftmenu.xml", true);
					xhttp.send();
				}
				
				showLeftMenu();
			</script>
          </ul>
        </nav>
        <!-- end .sidebar1 -->
      </div>

      <article class="content">
        <!-- TemplateBeginEditable name="pagetitle" -->
        <p class="PageTitle">Instructions</p>
        <!-- TemplateEndEditable -->

        
        <!-- TemplateBeginEditable name="content" -->
        <section>
          <h2>How to use this document</h2>
          <p>Be aware that the CSS for these layouts is heavily commented. If you do most of your work in Design view, have a peek at the code to get tips on working with the CSS for the fixed layouts. You can remove these comments before you launch your site. To learn more about the techniques used in these CSS Layouts, read this article at Adobe's Developer Center - <a href="http://www.adobe.com/go/adc_css_layouts">http://www.adobe.com/go/adc_css_layouts</a>.</p>
        </section>
        <!-- TemplateEndEditable -->

        <!-- end .content -->
      </article>
    

	<!-- Footer -->
    <footer>

      <span id="txtFooter">Students' Informations</span> 
	  <script language="javascript">
	  		function Author() {
				this.studentId = "";
				this.name = "";
				this.dob = "";
				this.className = "";
				this.teamLeader = "";
			}
	  
	  		function Author(studentId, name, dob, className, teamLeader) {
				this.studentId = studentId;
				this.name = name;
				this.dob = dob;
				this.className = className;
				this.teamLeader = teamLeader;
				
				this.show = function() {
					console.log(this.name + ' ' + this.dob + ' ' + this.studentId + ' ' + this.className + ' ' + this.teamLeader);
				}
				
				this.toString = function() {
					infos = this.name + ' ' + this.dob + ' ';
					if (this.teamLeader == "Yes")
						infos += "Nhóm trưởng";
				
					return (infos);
				}
			}
			
			function GetAuthorByXMLDocAtIndex(xmlDoc, index) {
				var author = null;
				studentId = xmlDoc.getElementsByTagName("StudentId")[index].firstChild.nodeValue;
				name = xmlDoc.getElementsByTagName("StudentName")[index].firstChild.nodeValue;
				dob = xmlDoc.getElementsByTagName("DoB")[index].firstChild.nodeValue;
				className = xmlDoc.getElementsByTagName("ClassName")[index].firstChild.nodeValue;
				teamLeader = xmlDoc.getElementsByTagName("TeamLeader")[index].firstChild.nodeValue;
				author = new Author(studentId, name, dob, className, teamLeader);
				
				return (author);
			} 
			
			function showFooterDetails() {
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
					if (xhttp.readyState == 4 && xhttp.status == 200) {
						xmlDoc = xhttp.responseXML;
						authors = xmlDoc.getElementsByTagName("StudentName");
						authorsInformations = "";
						
						for (i = 0; i < authors.length; i++) {
							authorsInformations += "<span>" + GetAuthorByXMLDocAtIndex(xmlDoc, i).toString() + "</span> <br>";
						}
						
						document.getElementById("txtFooter").innerHTML = authorsInformations;
					}
				}
				
				xhttp.open("GET", "data.xml", true);
				xhttp.send();
			}
			
			showFooterDetails();
	  </script>

    </footer>
	<!-- End Footer -->

    <!-- end .container -->
  </div>
</body>
</html>
