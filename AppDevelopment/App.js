import { StatusBar } from 'expo-status-bar';

// Imported by myself
import React, {useState, useEffect} from 'react';         // JSX Compilation  
import { Text, View, Button, Alert } from 'react-native'; // Core Components
import { css } from './assets/css/css';                   // Style - css
// Views
import HomeScreen from './Views/Home';                    
import LoginScreen from './Views/Login';                    

// React Navigation Module
import { NavigationContainer } from '@react-navigation/native';
import { createNativeStackNavigator } from '@react-navigation/native-stack';

export default function App() {
  const Stack = createNativeStackNavigator();

  return (
    <NavigationContainer>
      <Stack.Navigator>
        <Stack.Screen name="Home" component={HomeScreen} />
        <Stack.Screen name="Login" component={LoginScreen} />
      </Stack.Navigator>
    </NavigationContainer>
  );
}