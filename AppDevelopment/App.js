import { StatusBar } from 'expo-status-bar';

// Imported by myself
import React, {useState, useEffect} from 'react';         // JSX Compilation  
import { Text, View, Button, Alert } from 'react-native'; // Core Components
import { css } from './assets/css/css';                   // Style - css

// React Navigation Module
import { NavigationContainer } from '@react-navigation/native';
import { createNativeStackNavigator } from '@react-navigation/native-stack';

// Views
import {Home, Login, Rastreio} from './views'; //index
import { color } from 'react-native/Libraries/Components/View/ReactNativeStyleAttributes';

export default function App() {

  const Stack = createNativeStackNavigator();

  return (
      <NavigationContainer>
        <Stack.Navigator>
          <Stack.Screen 
            name="Home" 
            component={Home}
            options={{
              title:"Bem Vindo",
              headerTintColor: "white",
              headerStyle: {backgroundColor: '#777'},
              headerTitleAlign: 'center'
            }}
          />
          <Stack.Screen name="Login" component={Login} />
          <Stack.Screen name="Rastreio" component={Rastreio} />
          {/* <Stack.Screen name="AreaRestrita" component={AreaRestrita} /> */}
        </Stack.Navigator>
      </NavigationContainer>
  );
}