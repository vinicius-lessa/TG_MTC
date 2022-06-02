/**
 * File DOC
 * 
 * @Description Página 'EntryPoint' do Projeto. A partir daqui o usuário é redirecionado para outras páginas.
 * @ChangeLog 
 *  - Vinícius Lessa - 18/05/2022: Inclusão da documentação de Cebeçalho. Mudanças na utilização de Navigators, como nome nome de arquivos, suas funções e Localização no Projeto (Vide histórico de mudanças de cada arquivo).
 *  - Vinícius Lessa - 23/05/2022: Importação de Fontes Customizadas.
 *  - Vinícius Lessa - 25/05/2022: Implementação do Novo NAVIGATOR Drawer.
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
  TradePosts , 
  NewTradePost ,    
  Welcome ,
  SignIn , 
  SignUp ,  
} from './views'; //index

import MusicTradeCenter from './views/MusicTradeCenter';

import FeedMusical from './views/FeedMusical';

// Fonts
import { useFonts } from 'expo-font';

import AppLoading from 'expo-app-loading';

import SideBar from './views/components/SideBar';
import { css } from './assets/css/css';


export default function App() {
  
  // Load Fonts
  let [fontsLoaded] = useFonts({
    'BebasNeue': require('./assets/fonts/BebasNeue-Regular.ttf') ,
    'CenturyGothic': require('./assets/fonts/GOTHIC.ttf') ,
    'CenturyGothicB': require('./assets/fonts/GOTHICB.ttf') ,
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
      <Drawer.Navigator        
        drawerContent={ (props) => <SideBar {...props} /> }
        initialRouteName="TradePosts"        
        screenOptions={{          
          drawerLabelStyle: {
            fontSize: 20 ,
            fontFamily: 'CenturyGothic' ,                        
          },
        }}
      >
        {/* Anúncios (Antiga Home) */}
        <Drawer.Screen
          name='TradePosts'
          component={TradePosts}
          options={{
            drawerLabel: 'Anúncios',
            headerShown: false ,
            drawerActiveTintColor: '#eb1f36' ,
            drawerInactiveTintColor: '#000' ,
            unmountOnBlur: true,
          }}
        />

        {/* Criar Post */}
        <Drawer.Screen
          name='NewTradePost'
          component={NewTradePost}
          options={{
            drawerLabel: 'Novo Anúncio',
            headerShown: false ,            
            drawerActiveTintColor: '#eb1f36' ,
            drawerInactiveTintColor: '#000' ,
            unmountOnBlur: true,
          }}
        />
        
        {/* Music Trade Center */}
        <Drawer.Screen
          name='MusicTradeCenter'
          component={MusicTradeCenter}
          options={{
            drawerLabel: 'Music Trade Center',
            headerShown: false ,            
            drawerActiveTintColor: '#eb1f36' ,
            drawerInactiveTintColor: '#000' ,
          }}
        />

        {/* Feed Musical */}
        <Drawer.Screen
          name='FeedMusical'
          component={FeedMusical}
          options={{
            drawerLabel: 'Feed Musical',
            headerShown: false ,
            drawerActiveTintColor: '#eb1f36' ,
            drawerInactiveTintColor: '#000' ,
          }}
        />

        {/* SignIn */}
        <Drawer.Screen
          name="SignIn"
          component={SignIn}
          options={{
            drawerLabel: 'Entrar',
            headerShown: false ,
            drawerActiveTintColor: '#eb1f36' ,
            drawerInactiveTintColor: '#000' ,
            unmountOnBlur: true,
          }}
        />        
        
        {/* SignUp (Antigo 'Create') */}
        <Drawer.Screen
          name="SignUp"
          component={SignUp}
          options={{
            drawerLabel: 'Criar Conta',
            headerShown: false ,
            drawerActiveTintColor: '#eb1f36' ,
            drawerInactiveTintColor: '#000' ,
            unmountOnBlur: true,
            drawerItemStyle: {
              fontSize: 20 ,
              fontFamily: 'CenturyGothicB' ,              
              borderBottomWidth: 1 ,
              borderBottomColor: '#777676' ,
              paddingBottom: 15
            } ,
          }}
        />

        {/* Bem-Vindo */}
        <Drawer.Screen
          name="Welcome"
          component={Welcome}
          options={{
            headerShown: false ,
          }}
        />

        {/* <View style={css.hrLightGrey} /> */}

        <Drawer.Screen
          name="Quem Somos"
          component={SignUp}
          options={{
            headerShown: false ,            
            drawerActiveTintColor: '#eb1f36' ,
            drawerInactiveTintColor: '#000' ,
          }}
        />        

        <Drawer.Screen
          name="Ajuda"
          component={SignUp}
          options={{
            headerShown: false ,            
            drawerActiveTintColor: '#eb1f36' ,
            drawerInactiveTintColor: '#000' ,
          }}
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