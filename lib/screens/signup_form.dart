import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:flutter/widgets.dart';
import 'package:teskovid/screens/login_form.dart';

import 'get_started.dart';

class MySignUp extends StatelessWidget{
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,
      theme: ThemeData(
        fontFamily: 'Sans Serif',
        primarySwatch: Colors.blue,
        visualDensity: VisualDensity.adaptivePlatformDensity,
      ),
      home: Signup(),
    );
  }

}

class Signup extends StatefulWidget {
  Signup({Key key, this.title}) : super(key: key);

  final String title;

  @override
  _SignupState createState() => _SignupState();
}

class _SignupState extends State<Signup> {
  final _formLoginKey = GlobalKey<FormState>();
  final TextEditingController emailControl = TextEditingController();
  final TextEditingController passwordControl = TextEditingController();
  final TextEditingController nameControl = TextEditingController();
  final TextEditingController mobileNumberControl = TextEditingController();


  bool showPassword = true;
  bool isloading = false;
  var globeImage;

  @override
  void initState() {
    // TODO: implement initState
    super.initState();
    globeImage = AssetImage(
        "assets/images/globeImage.png"
    );
  }


  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Container(
          width: MediaQuery.of(context).size.width,
          height: MediaQuery.of(context).size.height,
          decoration: BoxDecoration(
            image: DecorationImage(
              image: globeImage,
              alignment: Alignment.topCenter,
              fit: BoxFit.fitWidth
            ),
              gradient: LinearGradient(
                  begin: Alignment.topRight,
                  end: Alignment.bottomLeft,
                  colors: [Color(0xff075404), Color(0xff919E08)]
              )
          ),
          child: Align(
                 alignment: Alignment.bottomCenter,
                   child: _signupFormField()
               )
        ),
    );
  }


  Widget _signupFormField() {
    return Container(
        width: 600,
        height: 420,
        padding: EdgeInsets.all(30),
        decoration: BoxDecoration(
            gradient: LinearGradient(
                begin: Alignment.topRight,
                end: Alignment.bottomLeft,
                colors: [Color(0xff075404), Color(0xff919E08)]
            ),
            borderRadius: BorderRadius.only(
                topLeft: Radius.circular(80.0),
                topRight: Radius.circular(80.0)
            )
        ),
        child: Form(
            key: _formLoginKey,
            child: SizedBox(
                width: 344,
                child: SingleChildScrollView(
                  child: Column(
                    children: [
                      SizedBox(height: 5,),
                      /*======================================*/
                      // User name input
                      TextFormField(
                        controller: nameControl,
                        validator: (nameControl) {
                          if (nameControl.isEmpty) {
                            return 'Please enter name';
                          }
                          return null;
                        },
                        keyboardType: TextInputType.name,
                        style: TextStyle(
                          color: Color(0xffFFFFFF),
                        ),
                        decoration: new InputDecoration(
                          //icon goes here
                          prefixIcon: Icon(
                            Icons.account_box_outlined,
                            color: Color(0xffFFFFFF),
                          ),
                          contentPadding: EdgeInsets.zero,
                          labelText: "Name",
                          hintText: "(eg. Joe Ernest)",
                          hintStyle: TextStyle(
                            color: Colors.lime,
                            fontWeight: FontWeight.normal,
                            fontSize: 14,
                          ),
                          labelStyle: TextStyle(
                              color: Color(0xffFFFFFF),
                              fontSize: 18,
                              fontWeight: FontWeight.normal
                          ),

                        ),
                      ),
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
                        style: TextStyle(
                          color: Color(0xffFFFFFF),
                        ),
                        decoration: new InputDecoration(
                          //icon goes here
                          prefixIcon: Icon(
                              Icons.email_outlined,
                              color: Color(0xffFFFFFF),
                            ),
                          contentPadding: EdgeInsets.zero,
                          labelText: "Username/Email",
                          hintText: "(eg. joe@work.com)",
                          hintStyle: TextStyle(
                            color: Colors.lime,
                            fontWeight: FontWeight.normal,
                            fontSize: 14,
                          ),
                          labelStyle: TextStyle(
                            color: Color(0xffFFFFFF),
                              fontSize: 18,
                              fontWeight: FontWeight.normal
                          ),

                        ),
                      ),
                      SizedBox(height: 5,),

                      /*======================================*/
                      // User mobile number input
                      TextFormField(
                        controller: mobileNumberControl,
                        validator: (mobileNumberControl) {
                          if (mobileNumberControl.isEmpty) {
                            return 'Please enter valid mobile Number!';
                          }
                          return null;
                        },
                        keyboardType: TextInputType.phone,
                        style: TextStyle(
                          color: Color(0xffFFFFFF),
                        ),
                        decoration: new InputDecoration(
                          //icon goes here
                          prefixIcon: Icon(
                            Icons.dialer_sip_outlined,
                            color: Color(0xffFFFFFF),
                          ),
                          contentPadding: EdgeInsets.zero,
                          labelText: "Mobile Number",
                          hintText: "(eg. +223-812-345-0987)",
                          hintStyle: TextStyle(
                            color: Colors.lime,
                            fontWeight: FontWeight.normal,
                            fontSize: 14,
                          ),
                          labelStyle: TextStyle(
                              color: Color(0xffFFFFFF),
                              fontSize: 18,
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
                        style: TextStyle(
                          color: Color(0xffFFFFFF),
                        ),
                        decoration: new InputDecoration(
                          // icon: Icon(),
                          prefixIcon: Icon(
                            Icons.lock_outlined,
                            color: Color(0xffFFFFFF),
                          ),
                          contentPadding: EdgeInsets.zero,
                          labelText: "Password",
                          labelStyle: TextStyle(
                            color: Color(0xffFFFFFF),
                              fontSize: 18,
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
                              color: Color(0xffFFFFFF),

                            ),
                          ),
                        ),
                      ),

                      SizedBox(height: 15,),

                      Container(
                        width: 230,
                        alignment: Alignment.centerLeft,
                        child: RaisedButton(
                          shape: RoundedRectangleBorder(
                            borderRadius: BorderRadius.circular(15),
                          ),
                          color: Colors.amberAccent,
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
                                      title: Text("Invalid format"),
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
                          child: Container(
                            alignment: Alignment.center,
                            child: Text(
                              "Sign up",
                              style: TextStyle(
                                  fontWeight: FontWeight.w900,
                                  fontSize: 20,
                                  color: Colors.white,
                                letterSpacing: 0.5
                              ),
                            ),
                          ),
                        ),
                      ),

                      SizedBox(
                        height: 30,
                      child: Row(
                        children: [
                          Divider(
                            indent: 20,
                            endIndent: 125,
                            color: Colors.white,
                            height: 50,
                          ),
                          Text("or",
                          style: TextStyle(
                            color: Color(0xffFFFFFF),
                            fontSize: 13
                            ),
                          ),
                          Divider(
                            indent: 50,
                            endIndent: 20,
                            color: Colors.white,
                            height: 50,
                          ),
                        ],
                      ),
                      ),
                      Container(
                        width: 220,
                        alignment: Alignment.centerLeft,
                        child: RaisedButton(
                            shape: RoundedRectangleBorder(
                              borderRadius: BorderRadius.circular(15),
                            ),
                            color: Colors.white,
                            onPressed: () {
                              Navigator.of(context).push(
                                  MaterialPageRoute(
                                    builder:(context) => Login(),
                                  )
                              );
                            },
                            child: Container(
                              alignment: Alignment.center,
                              child: Text(
                                  "Log in",
                                  style: TextStyle(
                                      fontWeight: FontWeight.bold,
                                      fontSize: 20,
                                      color: Colors.black,
                                    letterSpacing: 0.5,
                                  ),
                              ),
                            ),
                            padding: EdgeInsets.only(bottom: 5, top: 5),
                          ),
                      ),


                    ],
                  ),
                )
            )
        ),
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

