import { HttpClient } from '@angular/common/http';
import { Component, inject } from '@angular/core';
import { FormsModule } from '@angular/forms';

type Categorie = {
  id: number,
  titre: string,
  images: Image[];
};

type Image = {
  image_id: number,
  image_url: string;
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

    this.refresh();


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

  refresh() { 
    this.http.get<Categorie[]>('http://localhost:5000/categories')
    .subscribe(categories => this.categories = categories);
  }
  onClicAjouterImage() {
        this.http
      .post(
        'http://localhost:5000/image', {
        url: this.urlImageSaisie, 
        categorie_id: this.categorieSelectionner
      })
    .subscribe(resultat => this.refresh());
    // this.categories[this.categorieSelectionner].images.push(this.urlImageSaisie)
    this.urlImageSaisie = "";

    // this.sauvegarde();
  }
  
  onClicAjouterCategorie() {

            this.http
      .post(
        'http://localhost:5000/categorie', {
        titre: this.nomCategorieSaisie
      })
    .subscribe(resultat => this.refresh());
    // this.categories.push({
    //   titre: this.nomCategorieSaisie,
    //   images: [],
    // });
    this.nomCategorieSaisie = "";
  }

  onClicSupprimerCategorie(indexCategorie: number) {

    this.http.delete("http://localhost:5000/categorie/" + indexCategorie)
    .subscribe(resultat => this.refresh());

  // this.categories.splice(indexCategorie,1);

  // this.sauvegarde();
  }


  onClicDeplacerImage(
    indexCategorie: number, 
    indexImage: number, 
    descendre: boolean = true
  ) {
  const image = this.categories[indexCategorie].images[indexImage];
  const nouvelleCategorieId = this.categories[indexCategorie + (descendre ? 1 : -1)].id;

  this.http.put("http://localhost:5000/image/" + image.image_id {
    categorie_id: nouvelleCategorieId
  }).subscribe(resultat => this.refresh());
}
    // let url = this.categories[indexCategorie].images[indexImage];

    // this.categories[indexCategorie + (descendre ? 1 : -1) ].images.push(url);

    // this.categories[indexCategorie].images.splice(indexImage,1);

    // this.sauvegarde();
  

  onClicSupprimerImage(indexImage:number) {

    this.http.delete("http://localhost:5000/image/" + indexImage)
    .subscribe(resultat => this.refresh());

    // -- Exemple local storage
  //this.categories[indexCategorie].images.splice(indexImage,1);

  //this.sauvegarde();
  }

  sauvegarde() {
    localStorage.setItem("categories", JSON.stringify(this.categories));
  }

}
