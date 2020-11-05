import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:flutter/widgets.dart';

import 'get_started.dart';

class MainEntry extends StatefulWidget {
  MainEntry({Key key, this.title}) : super(key: key);

  final String title;

  @override
  _MainEntryState createState() => _MainEntryState();
}

class _MainEntryState extends State<MainEntry> {
  final _formLoginKey = GlobalKey<FormState>();
  final TextEditingController emailControl = TextEditingController();
  final TextEditingController passwordControl = TextEditingController();
  bool showPassword = true;
  bool isloading = false;


  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Container(
          decoration: BoxDecoration(
              gradient: LinearGradient(
                  begin: Alignment.topRight,
                  end: Alignment.bottomLeft,
                  colors: [Color(0xff075404), Color(0xff919E08)]
              )
          ),
          child: Column(
            // mainAxisAlignment: MainAxisAlignment.center,
            children: <Widget>[
              Image.asset("assets/images/humanHandWashing.png"),
              Container(
                // width: 100,
                // height: 400,
                child: Padding(
                  padding: const EdgeInsets.all(8.0),
                  child: Card(
                    child: _loginFormField()
                  ),
                ),
              )
            ],
          ),
        ),
    );
  }


  Widget _loginFormField() {
    return Form(
        key: _formLoginKey,
        child: SizedBox(
            width: 344,
            child: Column(
              children: [
                SizedBox(height: 5,),
                /*======================================*/

                /// Email input form
                TextFormField(
                  controller: emailControl,
                  validator: (emailControl) {
                    if (emailControl.isEmpty) {
                      return 'Please enter email';
                    }
                    return validateEmail(emailControl);
                  },
                  keyboardType: TextInputType.emailAddress,
                  decoration: new InputDecoration(
                    //icon goes here
                    contentPadding: EdgeInsets.zero,
                    labelText: "Username/Email",
                    hintText: "(eg. joe@work.com)",
                    hintStyle: TextStyle(
                      color: Colors.lime,
                      fontWeight: FontWeight.normal,
                      fontSize: 12,
                    ),
                    labelStyle: TextStyle(
                        fontSize: 12,
                        fontWeight: FontWeight.normal
                    ),
                  ),
                ),
                SizedBox(height: 5,),

                /*======================================*/

                /// Password input form
                TextFormField(
                  controller: passwordControl,
                  validator: (passwordControl) {
                    if (passwordControl.isEmpty) {
                      return 'Please enter password';
                    }
                    return validatePassword(passwordControl);
                  },
                  keyboardType: TextInputType.visiblePassword,
                  obscureText: showPassword,
                  decoration: new InputDecoration(
                    // icon: Icon(),
                    contentPadding: EdgeInsets.zero,
                    labelText: "Password",
                    labelStyle: TextStyle(
                        fontSize: 12,
                        fontWeight: FontWeight.normal),
                    suffixIcon: IconButton(
                      onPressed: () {
                        setState(() {
                          showPassword = !showPassword;
                        });
                      },
                      icon: Icon(
                        showPassword ? Icons.visibility_off : Icons.visibility,
                        size: 15,
                      ),
                    ),
                  ),
                ),

                Align(
                  alignment: Alignment.centerLeft,
                  child: TextButton(
                      onPressed: () {
                        // Navigator.of(context).push(
                        // MaterialPageRoute(
                        // builder: (context) => ResetPassword(),
                        // ),
                        // );
                      },
                      child: Row(
                        textDirection: TextDirection.rtl,
                        children: [
                          Text(
                            "Forgot Password",
                            style: TextStyle(
                              fontWeight: FontWeight.normal,
                              fontSize: 12,
                              color: Colors.black,
                            ),
                          ),
                        ],
                      )
                  ),
                ),
                SizedBox(height: 35,),

                Align(
                  alignment: Alignment.centerLeft,
                  child: TextButton(
                    onPressed: () {
                      final form = _formLoginKey.currentState;
                      if (form.validate()) {
                        form.save();

                        setState(() {
                          // registeredUser = UserService.loginUser(
                          //    email: emailControl.text,
                          //    password: passwordControl.text,
                          // );
                        });
                        //   showDialog(
                        //       context: context,
                        //       builder: (_) => AlertDialog(title: _success()),
                        //       // barrierColor: Colors.white,
                        //       useRootNavigator: true,
                        // );
                      }

                      // }
                      else {
                        return showDialog(
                          context: context,
                          builder: (_) =>
                              AlertDialog(
                                title: Text("Invalid Login"),
                              ),
                        );
                      }
                      // if(!isloading){
                      //     Navigator.of(context).push(
                      //         MaterialPageRoute(
                      //            builder: (context) => Dashboard(),
                      //         )
                      //     );
                      // }
                    },
                    child: Text(
                      "Log in",
                      style: TextStyle(
                          fontWeight: FontWeight.w900,
                          fontSize: 22,
                          color: Colors.black
                      ),
                    ),
                  ),
                ),

                SizedBox(height: 50,),
                Column(
                  crossAxisAlignment: CrossAxisAlignment.stretch,
                  children: [
                    RaisedButton(
                      onPressed: () {

                      },
                      child: Text("Sign up"),
                      color: Colors.white,
                      padding: EdgeInsets.only(bottom: 5, top: 5),
                    ),
                  ],
                ),


              ],
            )
        )
    );
  }
}



String validateEmail(String value) {
  if (value.isEmpty) {
    // The form is empty
    return "Enter email address";
  }
  // This is just a regular expression for email addresses
  String p = "[a-zA-Z0-9\+\.\_\%\-\+]{1,256}" +
      "\\@" +
      "[a-zA-Z0-9][a-zA-Z0-9\\-]{0,64}" +
      "(" +
      "\\." +
      "[a-zA-Z0-9][a-zA-Z0-9\\-]{0,25}" +
      ")+";
  RegExp regExp = new RegExp(p);

  if (regExp.hasMatch(value)) {
    // So, the email is valid
    return null;
  }
  // The pattern of the email didn't match the regex above.
  return 'Email is not valid';
}

String validatePassword(String value) {
  if (value.isEmpty) {
    return "Enter correct password";
  }
  return null;
}

