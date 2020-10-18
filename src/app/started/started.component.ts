import { JsonPipe } from '@angular/common';
import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { faHandsWash, faHeadSideMask, faPumpMedical } from '@fortawesome/free-solid-svg-icons';
import { routesName } from '../shared/app.config';

@Component({
  selector: 'app-started',
  templateUrl: './started.component.html',
  styleUrls: ['./started.component.scss'],
})
export class StartedComponent implements OnInit {
  isVisited: boolean = false;
  carouselItems: any[];

  constructor(private router: Router) {}

  ngOnInit(): void {
    this.isVisited = JSON.parse(localStorage.getItem('isVisited'));
    if (this.isVisited) {
      this.router.navigate([routesName.login.s]);
    }
    this.carouselItems=[
      {icon : faHeadSideMask,title : 'wear mask', desc:'it reduces you risk of getting the virus'},
      {icon : faHandsWash,title : 'wash you hand', desc:'it reduces you risk of getting the virus'},
      {icon : faPumpMedical,title : 'use hand sanitizer', desc:'it reduces you risk of getting the virus'},
    ]
  }

  loginPage() {
    if (!this.isVisited) {
      localStorage.setItem('isVisited', JSON.stringify(true));
      this.router.navigate([routesName.login.s]);
    }
  }
}
