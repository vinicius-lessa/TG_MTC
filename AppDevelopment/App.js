/**
 * File DOC
 * 
 * @Description Página 'EntryPoint' do Projeto. A partir daqui o usuário é redirecionado para outras páginas.
 * @ChangeLog 
 *  - Vinícius Lessa - 18/05/2022: Inclusão da documentação de Cebeçalho. Mudanças na utilização de Navigators, como nome nome de arquivos, suas funções e Localização no Projeto (Vide histórico de mudanças de cada arquivo).
 *  - Vinícius Lessa - 23/05/2022: Importação de Fontes Customizadas.
 * 
 */

// React Navigation Module
import 'react-native-gesture-handler'; // MUST be the first module Imported

import React from 'react'; // JSX Compilation

// React Navigation Module
import { NavigationContainer } from '@react-navigation/native';
// import { createNativeStackNavigator } from '@react-navigation/native-stack';
import { createDrawerNavigator } from '@react-navigation/drawer';

// Views
import { 
  TradePosts, 
  Welcome, 
  SignIn, 
  SignUp, 
  NewTradePost 
} from './views'; //index

// Fonts
import { useFonts } from 'expo-font';

import AppLoading from 'expo-app-loading';

// const Routes = createAppContainer(
//   createDrawerNavigator({
//     Welcome,
//     TradePosts,
//     SignIn,
//     SignUp,
//     NewTradePost,
//   })
// )

export default function App() {
  // Load Fonts
  let [fontsLoaded] = useFonts({
    'BebasNeue': require('./assets/fonts/BebasNeue-Regular.ttf') ,
    'CenturyGothic': require('./assets/fonts/GOTHIC.ttf')
  }) ;

  if (!fontsLoaded) {    
    return <AppLoading />;    
  }

  // React Navigation - Stack (Default) (https://reactnavigation.org/docs/hello-react-navigation/)
  // const Stack = createNativeStackNavigator();

  // React Navigation - Drawer (https://reactnavigation.org/docs/drawer-navigator/)
  const Drawer = createDrawerNavigator();

  return (
    <NavigationContainer>
      <Drawer.Navigator>

        {/* Bem-Vindo */}
        <Drawer.Screen          
          name="Bem Vindo"
          component={Welcome}
          options={{headerShown: false}}
        />

        {/* Anúncios (Antiga Home) */}
        <Drawer.Screen
          name="Anúncios"
          component={TradePosts}
          options={{headerShown: false}}

        />

        {/* SignIn (Antigo 'LogIn') */}
        <Drawer.Screen
          name="Entrar"
          component={SignIn}
          options={{headerShown: false}}
        />        
        
        {/* SignUp (Antigo 'Create') */}
        <Drawer.Screen
          name="Criar Conta"
          component={SignUp}
          options={{headerShown: false}}
        />

        {/* Criar Post (Antigo 'CreateAd') */}
        <Drawer.Screen
          name="Novo Post"
          component={NewTradePost}
          options={{headerShown: false}}
        />

      </Drawer.Navigator>
      
    </NavigationContainer>
    
    // <NavigationContainer>
    //   <Stack.Navigator>
        
    //     <Stack.Screen
    //       name="Welcome"
    //       component={Welcome}
    //       options={{headerShown: false}}
    //     />

    //     {/* Antiga Home */}
    //     <Stack.Screen
    //       name="TradePosts"
    //       component={TradePosts}
    //       options={{headerShown: false}}
    //     />

    //     {/* Antigo 'LogIn' */}
    //     <Stack.Screen
    //       name="SignIn"
    //       component={SignIn}
    //       options={{
    //         title:"",
    //         headerTintColor: "white",
    //         headerStyle: {backgroundColor: '#151516'},
    //         headerTitleStyle: {fontWeight: 'bold'},
    //         headerTitleAlign: 'center'
    //       }}          
    //     />        
        
    //     {/* Antigo 'Create' */}
    //     <Stack.Screen
    //       name="SignUp"
    //       component={SignUp}
    //       options={{headerShown: false}}
    //     />

    //     {/* Antigo 'CreateAd' */}
    //     <Stack.Screen
    //       name="NewTradePost"
    //       component={NewTradePost}
    //       options={{headerShown: false}}
    //     />        

    //   </Stack.Navigator>
    // </NavigationContainer>

    // <NavigationContainer>      
    //   <Stack.Navigator>
        
    //     <Stack.Screen
    //       name="Welcome"
    //       component={Welcome}
    //       options={{headerShown: false}}
    //     />

    //     {/* Antiga Home */}
    //     <Stack.Screen
    //       name="TradePosts"
    //       component={TradePosts}
    //       options={{headerShown: false}}
    //     />

    //     {/* Antigo 'LogIn' */}
    //     <Stack.Screen
    //       name="SignIn"
    //       component={SignIn}
    //       options={{
    //         title:"",
    //         headerTintColor: "white",
    //         headerStyle: {backgroundColor: '#151516'},
    //         headerTitleStyle: {fontWeight: 'bold'},
    //         headerTitleAlign: 'center'
    //       }}          
    //     />        
        
    //     {/* Antigo 'Create' */}
    //     <Stack.Screen
    //       name="SignUp"
    //       component={SignUp}
    //       options={{headerShown: false}}
    //     />

    //     {/* Antigo 'CreateAd' */}
    //     <Stack.Screen
    //       name="NewTradePost"
    //       component={NewTradePost}
    //       options={{headerShown: false}}
    //     />        

    //   </Stack.Navigator>
    // </NavigationContainer>
  );
}