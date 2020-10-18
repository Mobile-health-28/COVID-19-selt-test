import { Component, Input, OnInit } from '@angular/core';
import { FormControl } from '@angular/forms';

@Component({
  selector: 'app-error',
  templateUrl: './error.component.html',
  styleUrls: ['./error.component.scss'],
})
export class ErrorComponent implements OnInit {
  @Input() formControl: FormControl;

  errorObj: {
    class?;
    message?;
  } = {};
  constructor() {}

  ngOnInit(): void {}
  ngOnChanges() {
    if (this.formControl.invalid) {
      if (this.formControl.errors.required) {
        this.errorObj.class = 'error';
        this.errorObj.message = 'this field required';
      }
    } else {
      this.errorObj = {message:'',class:''};
    }
  }
}
