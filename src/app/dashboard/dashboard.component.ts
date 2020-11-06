import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';

@Component({
  selector: 'app-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.scss'],
})
export class DashboardComponent implements OnInit {
  form: FormGroup;

  constructor(
    private router: Router,
    private fb: FormBuilder,
    ) { }

    ngOnInit(): void {
      // this.initForm(); // initialize reactive form on component init
    }

    // build form controls
    // initForm(): void {
    //   this.form = this.fb.group({
    //     password: [null, Validators.required],
    //     username: [null, Validators.compose([Validators.required, Validators.email])]
    //   });
    // }

    // get formData() {
    //   return this.form.controls;
    // }

    // onSubmit(formPayload) {
    //   this.payload.email = formPayload.username.value;
    //   this.payload.password = formPayload.password.value;
    //   console.log('payload: ', this.payload);
    //   this.login(this.payload);
    // }

}
