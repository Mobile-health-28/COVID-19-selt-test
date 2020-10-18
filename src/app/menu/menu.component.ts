import { Component, OnInit } from '@angular/core';
import { faAlignJustify, faClosedCaptioning, faRemoveFormat, faTimes, IconDefinition } from '@fortawesome/free-solid-svg-icons';
import { routesName } from '../shared/routes';

@Component({
  selector: 'app-menu',
  templateUrl: './menu.component.html',
  styleUrls: ['./menu.component.scss']
})
export class MenuComponent implements OnInit {
  icons  = {
    menu : faAlignJustify,
    close : faTimes
  };
  menuItems=[
    {title : 'Home',path : routesName.home},
    {title : 'About', path : routesName.about},
    {title : 'Log out',path : routesName.logout},
  ]
  isHidden = true;
  constructor() { }

  ngOnInit(): void {
  }

  menuVisibility(){
    this.isHidden = !this.isHidden;
  }

}
