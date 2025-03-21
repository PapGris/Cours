import { Component } from '@angular/core';
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

  urlImageSaisie = ''

  ngOnInit() {
    const enregistrement = localStorage.getItem("categories");

    const categoriesParDefaut: Categorie[]= [
    {
      titre: "Parfait",
      images: [
      ],
    },
    {
      titre:"Très bien",
      images: [
    ],
    },
    {
      titre: "Bien",
      images: [
      ],
    },
    {
      titre: "Moyen",
      images: [
        
      ],
    },
    {
      titre: "Pas ouf",
      images: [
      ],
    }
  ];

    if(enregistrement == null) {
      localStorage.setItem("categories", JSON.stringify(categoriesParDefaut));
    }

    this.categories = JSON.parse(localStorage.getItem('categories')!);
  }
  
  categories: Categorie[]= [];
  //   {
  //     titre: "Parfait",
  //     images: [
  //       "https://yt3.googleusercontent.com/ytc/AIdro_lku65FtI9d5UoriHEWn5R7_GceLMru6QfPa-paGXhXvg=s900-c-k-c0x00ffffff-no-rj",
  //       "https://a0.anyrgb.com/pngimg/200/1382/kira-tsugumi-ohba-takeshi-obata-ryuk-light-yagami-lighting-designer-death-note-protagonist-l-wig.png",
  //       "https://cdn-images.dzcdn.net/images/cover/7c18a7762bf565a34c25bd01ef4099cc/0x1900-000000-80-0-0.jpg",
  //       "https://numpaint.com/wp-content/uploads/2020/11/Gon-Freecss-Fom-Hunter-X-Hnter-paint-by-numbers.jpg",
  //       "https://img.lemde.fr/2017/07/10/0/0/640/360/664/0/75/0/f689861_23931-5md8w3.ste4dvx6r.png",
  //       "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRPqrgpMZtikcBCLR3YB9KNXdklDaX2jJnfbA&s",
        
        
  //     ],
  //   },
  //   {
  //     titre:"Très bien",
  //     images: [
  //       "https://i.redd.it/0n2llx05e5p91.jpg",
  //       "https://boo-prod.b-cdn.net/database/profiles/16843254529621a10f1cafe46cea135b902a3aefe9014.jpg",
  //       "https://animeland.fr/wp-content/uploads/2024/09/Bleach01.jpg",
  //       "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ5_9L9O69AkY1AA9d6-wgOrZ_pccIC4XQGSA&s",
  //   ],
  //   },
  //   {
  //     titre: "Bien",
  //     images: [
  //       "https://preview.redd.it/kizaru-one-piece-vs-sukuna-jujutsu-kaisen-v0-dxngbg93yjjc1.jpg?width=640&crop=smart&auto=webp&s=fe79d7efb8c1bb0f9e098e5bda4285baaf26ece6",
  //       "https://boutique-one-piece.com/wp-content/uploads/2022/09/Poster-One-Piece-Luffy-Avec-Un-Grand-Sourire.jpg",
  //       "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQwZgAsfNUE9K4Sa3z0HpGopLB9PafTBTBkSJuFAzT_o54tO1u5gdl0TGtiBcvd_SOOu7s&usqp=CAU",
  //       "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQchltUWds4TyGQbtwPbyevF97kYDlNk1FVGQ&s",
  //     ],
  //   },
  //   {
  //     titre: "Moyen",
  //     images: [
  //       "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTsGlyL8a-t4iuwz6QCQAkm00FuClbqYjy6hxPwjg9s9f7dAS4rfi8NP8LfBwJf_1wpeo0&usqp=CAU",
  //       "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS6YKVSM9ORBv7mpuhD8mVF2rmIq1QAEix-ng&s",
        
  //     ],
  //   },
  //   {
  //     titre: "Pas ouf",
  //     images: [
  //       "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRGpNobNgVTnuf_LacjRhhQ8ogSqYAF_k5oQwSSOvPIrhqadsdb4uMEhcmdEURrCO60nKw&usqp=CAU",
  //       "https://media.licdn.com/dms/image/v2/D4E35AQExgk6nzb4a-g/profile-framedphoto-shrink_400_400/B4EZUoFHM1HMAc-/0/1740134184040?e=1743159600&v=beta&t=HvPLmbuT1KhHzMlmvJVKeVnSEN7rDTcwGj7XB9aksKY",

  //     ],
  //   }
  // ];

  onClicAjouterImage() {
    this.categories[0].images.push(this.urlImageSaisie)
    this.urlImageSaisie = ""
  }
}
