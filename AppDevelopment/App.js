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
import { createDrawerNavigator, DrawerContent } from '@react-navigation/drawer';

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
        initialRouteName="Anúncios"
        screenOptions={{          
          drawerLabelStyle: {
            fontSize: 20 ,
            fontFamily: 'CenturyGothic' ,
          },
        }}
      >
        {/* Anúncios (Antiga Home) */}
        <Drawer.Screen
          name="Anúncios"
          component={TradePosts}          
          options={{
            headerShown: false ,            
            drawerActiveTintColor: '#eb1f36' ,
            drawerInactiveTintColor: '#000' ,
          }}
        />

        {/* Criar Post (Antigo 'CreateAd') */}
        <Drawer.Screen
          name="Criar Anúncio"
          component={NewTradePost}
          options={{
            headerShown: false ,            
            drawerActiveTintColor: '#eb1f36' ,
            drawerInactiveTintColor: '#000' ,
          }}
        />
        
        <Drawer.Screen
          name="Music Trade Center"
          component={MusicTradeCenter}
          options={{
            headerShown: false ,            
            drawerActiveTintColor: '#eb1f36' ,
            drawerInactiveTintColor: '#000' ,
          }}
        />

        <Drawer.Screen
          name="Feed Musical"
          component={FeedMusical}
          options={{
            headerShown: false ,            
            drawerActiveTintColor: '#eb1f36' ,
            drawerInactiveTintColor: '#000' ,
          }}
        />

        {/* SignIn (Antigo 'LogIn') */}
        <Drawer.Screen
          name="Entrar"
          component={SignIn}
          options={{
            headerShown: false ,            
            drawerActiveTintColor: '#eb1f36' ,
            drawerInactiveTintColor: '#000' ,
          }}
        />        
        
        {/* SignUp (Antigo 'Create') */}
        <Drawer.Screen
          name="Criar Conta"
          component={SignUp}
          options={{
            headerShown: false ,
            drawerActiveTintColor: '#eb1f36' ,
            drawerInactiveTintColor: '#000' ,
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
        {/* <Drawer.Screen
          name="Bem Vindo"
          component={Welcome}
          options={{
            headerShown: false ,
          }}
        /> */}

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