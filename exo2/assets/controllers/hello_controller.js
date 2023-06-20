import { Controller } from "@hotwired/stimulus";

/*
 * This is an example Stimulus controller!
 *
 * Any element with a data-controller="hello" attribute will cause
 * this controller to be executed. The name "hello" comes from the filename:
 * hello_controller.js -> "hello"
 *
 * Delete this file or adapt it for your use!
 */
export default class extends Controller {
  static targets = ["input", "results"]; // Définition des éléments HTML qu'on veut utiliser

  connect() {
    // connexion du contrôleur à l'input
    this.inputTarget.addEventListener("input", () => {
      this.search(); // méthode de recherche
    });
  }

  search() {
    // effectuer la recherche lorsque l'utilisateur saisit des mots-clés dans l'input (minimum 3)
    const keywords = this.inputTarget.value;

    if (keywords.length >= 3) {
      fetch(`/search/${keywords}`)
        .then((response) => response.json())
        .then((data) => {
          //
          const resultat = this.resultsTarget;
          resultat.innerHTML = "";

          const listItems = data.map((item) => {
            // map des resultats pour les mettre dans des <li></li>
            const li = document.createElement("li"); // Création de la liste
            li.style.backgroundColor = "white";
            li.style.cursor = 'pointer';
            li.textContent = item.name;

            li.addEventListener("click", () => {
              const slug = item.name.toLowerCase().replace(/\s+/g, "-"); // Convertir en minuscules et remplacer les espaces par des tirets pour correspondre au slug
              window.location.href = `/view/${slug}`; // On redirige vers la place en question au click
            });

            return li;
          });

          listItems.forEach((li) => {
            resultat.appendChild(li);
          });
        })
        .catch((error) => {
          console.error(error);
        });
      // On efface le resultat quand les mots sont éffacés
    } else {
      const resultat = this.resultsTarget;
      resultat.innerHTML = "";
    }
  }
}
