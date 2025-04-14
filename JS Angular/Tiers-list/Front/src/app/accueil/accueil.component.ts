import { HttpClient } from '@angular/common/http';
import { Component, inject } from '@angular/core';
import { FormsModule } from '@angular/forms';

type Categorie = {
  titre: string; 
  images: string[];
};

@Component({
  selector: 'app-accueil',
  imports: [FormsModule],
  templateUrl: './accueil.component.html',
  styleUrl: './accueil.component.scss'
})
export class AccueilComponent {

  urlImageSaisie = '';
  categories: Categorie[]= [];
  categorieSelectionner = 0;
  nomCategorieSaisie = '';

  http = inject(HttpClient);


  ngOnInit() {

    this.http
      .get<Categorie[]>('http://localhost:5000/categories')
      .subscribe(categories => this.categories = categories);


  //   const enregistrement = localStorage.getItem("categories");

  //   const categoriesParDefaut: Categorie[]= [
  //   {
  //     titre: "Parfait",
  //     images: [
  //     ],
  //   },
  //   {
  //     titre:"Très bien",
  //     images: [
  //   ],
  //   },
  //   {
  //     titre: "Bien",
  //     images: [
  //     ],
  //   },
  //   {
  //     titre: "Moyen",
  //     images: [
        
  //     ],
  //   },
  //   {
  //     titre: "Pas ouf",
  //     images: [
  //     ],
  //   }
  // ];

  //   if(enregistrement == null) {
  //     localStorage.setItem("categories", JSON.stringify(categoriesParDefaut));
  //   }

  //   this.categories = JSON.parse(localStorage.getItem('categories')!);
  }

  onClicAjouterImage() {
    this.categories[this.categorieSelectionner].images.push(this.urlImageSaisie)
    this.urlImageSaisie = "";

    this.sauvegarde();
  }
  
  onClickAjouterCategorie() {
    this.categories.push({
      titre: this.nomCategorieSaisie,
      images: [],
    });
    this.nomCategorieSaisie = "";
  }

  onClicSupprimerCategorie(indexCategorie: number) {
  this.categories.splice(indexCategorie,1);

  this.sauvegarde();
  }

  onClicDeplacerImage(indexCategorie: number,indexImage: number, descendre :boolean = true) {
    let url = this.categories[indexCategorie].images[indexImage];

    this.categories[indexCategorie + (descendre ? 1 : -1) ].images.push(url);

    this.categories[indexCategorie].images.splice(indexImage,1);

    this.sauvegarde();
  }

  onClicSupprimerImage(indexCategorie: number,indexImage:number) {

    // -- Exemple local storage
  //this.categories[indexCategorie].images.splice(indexImage,1);

  //this.sauvegarde();
  }

  sauvegarde() {
    localStorage.setItem("categories", JSON.stringify(this.categories));
  }

}
