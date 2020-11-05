import 'package:carousel_slider/carousel_slider.dart';
import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:flutter/widgets.dart';
import 'package:teskovid/screens/main_entry.dart';

class Starter extends StatefulWidget {
  Starter({Key key, this.title}) : super(key: key);

  final String title;

  @override
  _StarterState createState() => _StarterState();
}

class _StarterState extends State<Starter> {
  CarouselController carouselController = CarouselController();

  @override
  Widget build(BuildContext context) {

    return Scaffold(
      body: Container(
          width: MediaQuery.of(context).size.width,
          height: MediaQuery.of(context).size.height,
          decoration: BoxDecoration(
              gradient: LinearGradient(
                  begin: Alignment.topRight,
                  end: Alignment.bottomLeft,
                  colors: [Color(0xff075404), Color(0xff919E08)]
              )
          ),
          child: SafeArea(
            child: Column(
                children: <Widget>[
                  Align(
                    alignment: Alignment.topCenter,
                    child: Container(
                      margin: const EdgeInsets.all(8.0),
                      padding: const EdgeInsets.all(25.0),
                      child: new Card(
                        elevation: 20,
                        color: const Color(0xffFFFFFF).withOpacity(0.3),
                        shape: RoundedRectangleBorder(
                          borderRadius: BorderRadius.circular(28),
                        ),
                        child: new CarouselSlider(
                            items: <Widget>[
                              Column(
                                  mainAxisAlignment: MainAxisAlignment.center,

                                  children: [
                                    listItems[0].imageValue,
                                    Text(
                                        "Wear Mask\n It  reduces your risk of getting the virus",
                                      style: TextStyle(
                                        fontStyle: FontStyle.normal,
                                        fontWeight: FontWeight.bold,
                                        fontSize: 16,
                                        color: Color(0xffFFFFFF),
                                      ),
                                      textAlign: TextAlign.center,
                                    )
                                  ]
                              ),
                              Column(
                                  mainAxisAlignment: MainAxisAlignment.center,

                                  children: [
                                    listItems[1].imageValue,
                                    Text(
                                      "Wash Your Hands\n It  reduces your risk of getting the virus",
                                      style: TextStyle(
                                        fontStyle: FontStyle.normal,
                                        fontWeight: FontWeight.bold,
                                        fontSize: 16,
                                        color: Color(0xffFFFFFF),
                                      ),
                                      textAlign: TextAlign.center,
                                    )
                                  ]
                              ),
                              Column(
                                  mainAxisAlignment: MainAxisAlignment.center,

                                  children: [
                                    listItems[2].imageValue,
                                    Text(
                                      "Use Hand Sanitizer\n It  reduces your risk of getting the virus",
                                      style: TextStyle(
                                        fontStyle: FontStyle.normal,
                                        fontWeight: FontWeight.bold,
                                        fontSize: 16,
                                        color: Color(0xffFFFFFF),
                                      ),
                                      textAlign: TextAlign.center,
                                    )
                                  ]
                              ),

                            ],
                            carouselController: carouselController,
                            options: CarouselOptions(
                              height: 400,
                              initialPage: 0,
                              enlargeCenterPage: true,
                              autoPlay: true,
                              scrollDirection: Axis.horizontal,

                            ),
                        ),
                      ),
                    ),
                  ),
                  SizedBox(height: 150,),
                  Align(
                    alignment: Alignment.bottomCenter,
                    child: Container(
                      margin: const EdgeInsets.all(4.0),
                      padding: const EdgeInsets.all(20.0),
                      child: new Card(
                        shape: RoundedRectangleBorder(
                          borderRadius: BorderRadius.circular(30),
                        ),
                        color: Colors.amberAccent,
                        child: FlatButton(
                          // shape: ,
                          onPressed: (){
                            Navigator.of(context).push(
                              MaterialPageRoute(
                                  builder:(context) => MainEntry(),
                              )
                            );
                          },
                          child: Text("GET STARTED",
                            style: TextStyle(
                              fontWeight: FontWeight.bold,
                              fontSize: 18,
                              letterSpacing: 0.9,
                            ),
                          ),

                        ),
                      ),
                    ),
                  )
                ],
              ),
          ),
          ),
    );
  }
}

class StartImage {
  final Widget imageValue;
  final String imageName;

  StartImage({this.imageValue, this.imageName});
}

List<StartImage> listItems = [
  StartImage(imageName: 'globe', imageValue: Image.asset("assets/images/showingHands.png",)),
  StartImage(imageName: 'washHand', imageValue: Image.asset("assets/images/washingHand.png")),
  StartImage(imageName: 'sanitzeHand', imageValue: Image.asset("assets/images/sanitizingHand.png"))

];
