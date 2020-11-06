import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormControl, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { IUser } from 'src/app/core/models/user';
import { AuthService } from '../../core/services/auth.service';

@Component({
  selector: 'app-signup',
  templateUrl: './signup.component.html',
  styleUrls: ['./signup.component.scss'],
})

export class SignupComponent implements OnInit {
  form: FormGroup;
  payload: IUser;
  signupError: {status: boolean, message: string} = {status: false, message: ''};

  constructor(
    private router: Router,
    private fb: FormBuilder,
    private auth: AuthService
    ) { }

    ngOnInit(): void {
      this.initForm(); // initialize reactive form on component init
    }

    // build form controls
    initForm(): void {
      this.form = this.fb.group({
        name: [null, Validators.required],
        email: [null, Validators.compose([Validators.required, Validators.email])],
        password: [null, Validators.required],
        phone: [null, Validators.compose([Validators.required, Validators.pattern('^[0-9]*$'), Validators.minLength(11)])]
      });
    }

    get formData() {
      return this.form.controls;
    }

    onSubmit(formPayload) {
      if (this.signupError.status === true){
        this.signupError = {
                            status: false,
                            message: ''
                          };
      }
      this.payload = {
                        email: formPayload.email.value,
                        name: formPayload.name.value,
                        phone: formPayload.phone.value,
                        password: formPayload.password.value,
                        persistent: true
                      };
      console.log('payload: ', this.payload);
      this.signUp(this.payload);
    }

    signUp(payload: IUser) {
      this.auth.register(payload).subscribe(
        data => {
          console.log(data);
        },
        error => {
          if (error.status === 422) {
            this.signupError = {
                                status: true,
                                message: error.error.message
                              };
          } else {
            this.signupError = {
                                status: true,
                                message: error.error.message
                              };
          }
        }
      );
    }
}

