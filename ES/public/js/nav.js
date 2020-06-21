$(document).ready(function() {
    $(".account").click(function() { 
        document.getElementById('btn-caret').style.display="none";
        document.getElementById('down-caret').style.display="block";
        $("#content-stud").slideDown();
        $("#content-prof").slideDown();
        document.getElementById("content-stud").style.display="block"; 
        document.getElementById("content-prof").style.display="block";   
    });

    $(".account-hide").click(function() {
        document.getElementById('btn-caret').style.display="block";
        document.getElementById('down-caret').style.display="none";
        $("#content-stud").slideUp();
        $("#content-prof").slideUp();
    });

    $("#content-stud").click(function() {
        document.getElementById("btn-caret").style.display="none";
        document.getElementById("down-caret").style.display="block";
        document.getElementById("content-stud").style.display="block";    
        document.getElementById("content-stud").style.fontWeight="600";   
        document.getElementById("content-prof").style.display="block";       
           
    });
    
    var o = 0;
    $(".toggle-show").click(function() {

        document.getElementById("nav-side").style.display="block";
        document.getElementById("main").style.display="none";
        document.getElementById("nav-side").style.width="100%";
        document.getElementById("nav-side").style.background="#F5F5F5";
        document.getElementById("nav-side").style.marginTop="50px";
        document.getElementById("nav-side").style.marginLeft="0px";    
        document.getElementById("nav-side").style.height="100%";  

        $(".toggle-show").hide();
        $(".toggle-hide").show();
        $("#nav-side").slideDown();   
        $("#dashoard").slideDown();
        $("#profile").slideDown();
        $("#account").slideDown();
        $("#credential").slideDown();
        $("#report").slideDown();
        $("#system").slideDown();
        $("#student-btn").hide();
        $(".title-logo").hide(); 
        o=1;   
    });

    $(".toggle-hide").click(function() {
        $(".toggle-show").show();
        $(".toggle-hide").hide();  
        $("#nav-side").slideUp();   
        $("#dashoard").slideUp();
        $("#profile").slideUp();
        $("#account").slideUp();
        $("#credential").slideUp();
        $("#report").slideUp();
        $("#system").slideUp();
        $("#content-stud").slideUp();
        $("#content-prof").slideUp();
        
        document.getElementById('btn-caret').style.display="block";
        document.getElementById("main").style.display="block";
        document.getElementById('down-caret').style.display="none";
        
        $(".title-logo").fadeIn("slow");
        $("#student-btn").fadeIn("slow");
        o=1;
    });

    toggleHide();

    function toggleHide() {
        if(o==1) 
        {
            document.getElementById("nav-side").style.display="block";
            // document.getElementById("nav-side").style.backgroundColor="#f5f5f5";
            // document.getElementById("nav-side").style.zIndex="1";
            o=0;
        }
    }

});