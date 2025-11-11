document.querySelector(".BlocCommentaire").style.display = "none";


let actif = 1;
document
  .querySelector(".activeCommentaire")
  .addEventListener("click", function () {
    
    if (actif == 0) {
      document.querySelector(".BlocCommentaire").style.display = "none";
      actif = 1;
      document.querySelector(".activeCommentaire").innerHTML = 'Afficher les commentaires';
    } else {
      document.querySelector(".BlocCommentaire").style.display = "block";
      actif = 0;
      document.querySelector(".activeCommentaire").innerHTML = 'Cacher les commentaires';
    }
  });
