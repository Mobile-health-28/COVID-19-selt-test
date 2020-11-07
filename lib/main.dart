import 'package:flutter/material.dart';
import 'package:teskovid/screens/get_started.dart';
import 'package:teskovid/screens/login_form.dart';

void main() {
  runApp(MyApp());
}

class MyApp extends StatelessWidget {
  // This widget is the root of your application.
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'Teskovid',
      theme: ThemeData(
        fontFamily: 'Sans Serif',
        primarySwatch: Colors.blue,
        visualDensity: VisualDensity.adaptivePlatformDensity,
      ),
      home: Starter(title: 'Covid 19 Self Test'),
    );
  }
}


