import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { apiEndPoint } from '../shared/app.config';

@Injectable({
  providedIn: 'root'
})
export class QuestionService {

  constructor(private http : HttpClient) { }

  get_products(){
    return this.http.get(apiEndPoint.get_questions);
  }

  get_product(id){
    return this.http.get(apiEndPoint.get_question+id)
  }

  get_choices(productId){
    return this.http.get(apiEndPoint.get_question+productId+apiEndPoint.get_choices)
  }

}
