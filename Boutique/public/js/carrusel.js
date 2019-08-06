 var slideindex=0;
  showSlides();
  function showSlides()
  {
      var i;
      var slides=document.getElementsByClassName("mySlides");
      
      for ( i = 0; i < slides.length; i++ ) {
        slides[i].style.display="none";
       }

       slideindex++;
       if (slideindex > slides.length) {slideindex=1;}
        slides[slideindex-1].style.display="block";
      setTimeout(showSlides,2000);
  }