import { Component, OnInit, ViewChild } from '@angular/core';
import { Router } from '@angular/router';
// import { faHandsWash, faHeadSideMask, faPumpMedical } from '@fortawesome/free-solid-svg-icons';
import { NgbCarousel, NgbSlideEvent, NgbSlideEventSource } from '@ng-bootstrap/ng-bootstrap';


@Component({
  selector: 'app-started',
  templateUrl: './started.component.html',
  styleUrls: ['./started.component.scss'],
})
export class StartedComponent implements OnInit {
  @ViewChild('carousel', {static : true}) carousel: NgbCarousel;

  isVisited = false;

  paused = false;
  unpauseOnArrow = false;
  pauseOnIndicator = false;
  pauseOnHover = true;
  pauseOnFocus = true;
  carouselItems = [
    {image : '../../assets/images/Document.png', title : 'wear mask', desc: 'it reduces your risk of getting the virus'},
    {image : '../../assets/images/Handwashing.png', title : 'wash your hand', desc: 'it reduces your risk of getting the virus'},
    {image : '../../assets/images/ES_dwp7XkAAYlUV.png', title : 'use hand sanitizer', desc: 'it reduces your risk of getting the virus'},
  ];

  constructor(private router: Router) {}

  ngOnInit(): void {
    // this.isVisited = JSON.parse(localStorage.getItem('isVisited'));
    // if (this.isVisited) {
    //   this.router.navigate(['/auth/login']);
    // }
  }

  togglePaused() {
    if (this.paused) {
      this.carousel.cycle();
    } else {
      this.carousel.pause();
    }
    this.paused = !this.paused;
  }

  onSlide(slideEvent: NgbSlideEvent) {
    if (this.unpauseOnArrow && slideEvent.paused &&
      (slideEvent.source === NgbSlideEventSource.ARROW_LEFT || slideEvent.source === NgbSlideEventSource.ARROW_RIGHT)) {
      this.togglePaused();
    }
    if (this.pauseOnIndicator && !slideEvent.paused && slideEvent.source === NgbSlideEventSource.INDICATOR) {
      this.togglePaused();
    }
  }

  goTologinPage() {
    if (!this.isVisited) {
      localStorage.setItem('isVisited', JSON.stringify(true));
      this.router.navigate(['/auth/login']);
    }
  }
}
