import 'package:carousel_slider/carousel_slider.dart';
import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:flutter/widgets.dart';
import 'package:teskovid/screens/login_form.dart';

class MyStarter extends StatelessWidget{
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,
      theme: ThemeData(
        fontFamily: 'Sans Serif',
        primarySwatch: Colors.blue,
        visualDensity: VisualDensity.adaptivePlatformDensity,
      ),
      home: Starter(title: 'Covid 19 Self Test'),
    );
  }

}


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
                        color: const Color(0xffFFFFFF).withOpacity(0.4),
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
                  SizedBox(height: 60,),

                  // ================== for button ======
                  Container(
                    width: 200,
                    alignment: Alignment.centerLeft,
                    child: RaisedButton(
                      shape: RoundedRectangleBorder(
                        borderRadius: BorderRadius.circular(15),
                      ),
                      color: Colors.amberAccent,
                      onPressed: () {
                        Navigator.of(context).push(
                            MaterialPageRoute(
                              builder:(context) => MyLogin(),
                            )
                        );
                      },
                      child: Container(
                        alignment: Alignment.center,
                        child: Text(
                          "GET STARTED",
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
                  ),                ],
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
