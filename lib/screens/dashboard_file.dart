
import 'package:carousel_slider/carousel_slider.dart';
import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:flutter/rendering.dart';
import 'package:flutter/widgets.dart';

class MyDashboard extends StatelessWidget{
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,
      theme: ThemeData(
        fontFamily: 'Sans Serif',
        primarySwatch: Colors.blue,
        visualDensity: VisualDensity.adaptivePlatformDensity,
      ),
      home: Dashboard(),
    );
  }

}

class Dashboard extends StatefulWidget {
  Dashboard({Key key, this.title}) : super(key: key);

  final String title;

  @override
  _DashboardState createState() => _DashboardState();
}

class _DashboardState extends State<Dashboard> {


  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Center(
        child: Container(
          width: MediaQuery.of(context).size.width,
          height: MediaQuery.of(context).size.height,
          decoration: BoxDecoration(
              gradient: LinearGradient(
                  begin: Alignment.topRight,
                  end: Alignment.bottomLeft,
                  colors: [Color(0xff075404), Color(0xff919E08)]
              )
          ),
          child: Column(
              children: [
                SizedBox(height: 40,),
                Align(
                  alignment: Alignment.topLeft,
                  child: IconButton(
                      onPressed: (){

                      }, icon: Icon(
                      Icons.menu,
                    color: Colors.white,
                  ),
                  ),
                ),
              new Container(
                alignment: Alignment.topLeft,
                margin: EdgeInsets.only(left: 20),
                child: new Text(
                  "Hello,",
                  style: TextStyle(
                    fontWeight: FontWeight.bold,
                    color: Colors.limeAccent,
                    fontSize: 50
                  ),
                ),
              ),
              new Container(
                alignment: Alignment.topLeft,
                margin: EdgeInsets.only(left: 25),
                child: new Text(
                  "${AutofillHints.username}",
                  style: TextStyle(
                      fontWeight: FontWeight.normal,
                      color: Colors.limeAccent,
                      fontSize: 20
                  ),
                ),
              ),
              SizedBox(
                height: 20,
              ),

               Row(
                children: <Widget>[
                  Expanded(
                    flex: 5,
                    child: Container(
                      margin: const EdgeInsets.all(5.0),
                      // padding: const EdgeInsets.all(25.0),
                      height: 150,
                      width: 150,
                      child: new Card(
                        elevation: 20,
                        color: const Color(0xffFFFFFF).withOpacity(0.8),
                        shape: RoundedRectangleBorder(
                          borderRadius: BorderRadius.circular(28),
                        ),
                        child: FlatButton(
                          splashColor: Colors.lime,
                          shape: RoundedRectangleBorder(
                            borderRadius: BorderRadius.circular(28),
                          ),
                          onPressed: () {
                            showDialog(
                              context: context,
                              builder: (BuildContext context){
                                return AlertDialog(
                                  scrollable: true,
                                  title: Text("NOTICE",
                                  style: TextStyle(
                                      color: Colors.redAccent,
                                      fontWeight: FontWeight.bold),
                                  ),
                                  content: Text(
                                    "Our interactive COVID-19 self-test is not meant to take the place of consultation with your "
                                      "health care provider or to diagnose or treat conditions. This self-test will help you assess your symptoms "
                                      "and determine if you at a high risk of suffering from COVID-19 or not. It also offers guidance on how to "
                                      "protect yourself and others from COVID-19.",
                                    style: TextStyle(fontSize: 16,),
                                  ),
                                  actions: [
                                    FlatButton(
                                      onPressed: (){

                                      },
                                       child: Text("I Understand",
                                       style: TextStyle(
                                         fontWeight: FontWeight.bold
                                       ),
                                       ),
                                )
                                  ],
                                );
                              }
                            );
                          },
                          child: Column(
                            mainAxisAlignment: MainAxisAlignment.center,
                            children: [
                              new Text(
                                  "TAKE A\n SELF\n ASSESSMENT",
                                textAlign: TextAlign.center,
                                style: TextStyle(
                                  fontSize: 20,
                                  fontWeight: FontWeight.bold,

                                ),
                              ),
                              SizedBox(
                                height: 10,
                              ),

                              new Text(
                                  "Answer series of questions to determine your status",
                                textAlign: TextAlign.center,
                                textWidthBasis: TextWidthBasis.parent,
                              ),
                            ]
                          ),
                        )
                        )
                      ),
                  ),
                  // SizedBox(width: 5,),
                  Expanded(
                    flex: 5,
                    child: Container(
                        margin: const EdgeInsets.all(5.0),
                        // padding: const EdgeInsets.all(25.0),
                        height: 150,
                        width: 150,
                        child: new Card(
                            elevation: 20,
                            color: const Color(0xffFFFFFF).withOpacity(0.8),
                            shape: RoundedRectangleBorder(
                              borderRadius: BorderRadius.circular(28),
                            ),
                            child: FlatButton(
                              splashColor: Colors.lime,
                              shape: RoundedRectangleBorder(
                                borderRadius: BorderRadius.circular(28),
                              ),
                              onPressed: () {

                              },
                              child: Column(
                                  mainAxisAlignment: MainAxisAlignment.center,
                                  children: [
                                    new Text(
                                      "check\nsymptoms".toUpperCase(),
                                      textAlign: TextAlign.center,
                                      style: TextStyle(
                                        fontSize: 20,
                                        fontWeight: FontWeight.bold,
                                      ),
                                    ),
                                    SizedBox(
                                      height: 10,
                                    ),

                                    new Text(
                                      "Developing certain symptoms and you don't "
                                          "know what it is?\nInput your symptoms\nwe predict your risk status",
                                      textAlign: TextAlign.center,

                                    ),
                                  ]
                              ),
                            )
                        )
                    ),
                  ),
                ],
               ),

                SizedBox(height: 100,),

                new Container(
                  alignment: Alignment.center,
                  margin: EdgeInsets.only(left: 20),
                  child: new Text(
                    "Safety Precautions",
                    style: TextStyle(
                        fontWeight: FontWeight.bold,
                        color: Colors.white,
                        fontSize: 16
                    ),
                  ),
                ),

                Align(
                  alignment: Alignment.centerLeft,
                  child: Container(
                      margin: const EdgeInsets.only(left:15.0, right: 15.0),
                      // padding: const EdgeInsets.all(25.0),
                      height: 150,
                      width: 350,
                      child: new Card(
                          elevation: 20,
                          color: Colors.limeAccent.withOpacity(0.7),
                          shape: RoundedRectangleBorder(
                            borderRadius: BorderRadius.circular(28),
                          ),
                          child: Padding(
                            padding: const EdgeInsets.only(top: 50),
                            child: new Text(
                                      "Use Hand Sanitizer",
                                      textAlign: TextAlign.center,
                                      style: TextStyle(
                                        fontSize: 20,
                                        color: Color(0xffFFFFFF),
                                        fontWeight: FontWeight.bold,
                                      ),
                                    ),
                          ),

                      )
                  ),
                ),
        ]
            ),
          ),
          ),
    );
  }
}





