import { Component, OnInit } from '@angular/core';
import { FormControl, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { AuthService } from '../services/auth.service';
import { routesName } from '../shared/app.config';

@Component({
  selector: 'app-signup',
  templateUrl: './signup.component.html',
  styleUrls: ['./signup.component.scss'],
})
export class SignupComponent implements OnInit {
  signupForm: any;
  constructor(private router: Router, private auth: AuthService) {
    this.signupForm = new FormGroup({
      email: new FormControl('user1@mail.com', [
        Validators.email,
        Validators.required,
      ]),
      password: new FormControl('PassWord12345', [Validators.required]),
      phone: new FormControl('22996242162', [Validators.required]),
      name: new FormControl('hamid outm', [Validators.required]),
    });
  }
  ngOnInit(): void {}
  loginPage() {
    this.router.navigate([routesName.login.s]);
  }
  submit() {
    let values = this.signupForm.value;
    if (this.signupForm.valid) {
      console.error(values);
      values.persistent = true;
      this.auth.register(values).subscribe(
        (res) => {
          console.warn(res);
        },
        (error) => {
          console.error(values,error);
          
        }
      );
    }
  }
}
