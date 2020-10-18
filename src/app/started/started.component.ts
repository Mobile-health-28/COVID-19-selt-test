import { JsonPipe } from '@angular/common';
import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { routesName } from '../shared/routes';

@Component({
  selector: 'app-started',
  templateUrl: './started.component.html',
  styleUrls: ['./started.component.scss'],
})
export class StartedComponent implements OnInit {
  isVisited: boolean = false;
  carouselItems: { image: string; title: string; desc: string; }[];

  constructor(private router: Router) {}

  ngOnInit(): void {
    this.isVisited = JSON.parse(localStorage.getItem('isVisited'));
    if (this.isVisited) {
      this.router.navigate(['/' + routesName.login]);
    }
    this.carouselItems=[
      {image : 'https://cdn.jpegmini.com/user/images/slider_puffin_before_mobile.jpg',title : 'wear mask', desc:'it reduces you risk of getting the virus'},
      {image : 'https://cdn.jpegmini.com/user/images/slider_puffin_before_mobile.jpg',title : 'wash you hand', desc:'it reduces you risk of getting the virus'},
      {image : 'https://cdn.jpegmini.com/user/images/slider_puffin_before_mobile.jpg',title : 'use hand sanitizer', desc:'it reduces you risk of getting the virus'},
    ]
  }

  loginPage() {
    if (!this.isVisited) {
      localStorage.setItem('isVisited', JSON.stringify(true));
      this.router.navigate(['/' + routesName.login]);
    }
  }
}
