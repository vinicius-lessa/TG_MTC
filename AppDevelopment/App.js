//Import das bibliotecas
import React from 'react';
import { StatusBar } from 'react-native';
import { NavigationContainer } from '@react-navigation/native';
import Routes from './src/routes';

//Função base App e cor da barra 
export default function App() {
  return (
    <NavigationContainer>
      <StatusBar backgroundColor="black" barStyle='ligth-content'/>
      <Routes/>
    </NavigationContainer>
  );
}


