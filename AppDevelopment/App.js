/**
 * File DOC
 * 
 * @Description Página 'EntryPoint' do Projeto. A partir daqui o usuário é redirecionado para outras páginas.
 * @ChangeLog 
 *  - Vinícius Lessa - 18/05/2022: Inclusão da documentação de Cebeçalho. Mudanças na utilização de Navigators, como nome nome de arquivos, suas funções e Localização no Projeto (Vide histórico de mudanças de cada arquivo).
 *  - Vinícius Lessa - 23/05/2022: Importação de Fontes Customizadas.
 * 
 */

import React, {useState, useEffect} from 'react'; // JSX Compilation
import { Text, View } from 'react-native';        // Components

// React Navigation Module
import { NavigationContainer } from '@react-navigation/native';
import { createNativeStackNavigator } from '@react-navigation/native-stack';

// Views
import { TradePosts, Welcome, SignIn, SignUp, NewTradePost } from './views'; //index

// Fonts
import { useFonts } from 'expo-font';

import AppLoading from 'expo-app-loading';

 
export default function App() {

  // Load Fonts
  let [fontsLoaded] = useFonts({
    'BebasNeue': require('./assets/fonts/BebasNeue-Regular.ttf') ,
    'CenturyGothic': require('./assets/fonts/GOTHIC.ttf')
  }) ;

  if (!fontsLoaded) {    
    return <AppLoading />;    
  }

  const Stack = createNativeStackNavigator();

  return (
    <NavigationContainer>      
      <Stack.Navigator>
        
        <Stack.Screen
          name="Welcome"
          component={Welcome}
          options={{headerShown: false}}
        />

        {/* Antiga Home */}
        <Stack.Screen
          name="TradePosts"
          component={TradePosts}
          options={{headerShown: false}}
        />

        {/* Antigo 'LogIn' */}
        <Stack.Screen
          name="SignIn"
          component={SignIn}
          options={{headerShown: false}}
        />        
        
        {/* Antigo 'Create' */}
        <Stack.Screen
          name="SignUp"
          component={SignUp}
          options={{headerShown: false}}
        />

        {/* Antigo 'CreateAd' */}
        <Stack.Screen
          name="NewTradePost"
          component={NewTradePost}
          options={{headerShown: false}}
        />        

      </Stack.Navigator>
    </NavigationContainer>
  );
}