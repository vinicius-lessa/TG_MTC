/**
 * File DOC
 * 
 * @Description Página 'EntryPoint' do Projeto. A partir daqui o usuário é redirecionado para outras páginas.
 * @ChangeLog 
 *  - Vinícius Lessa - 18/05/2022: Inclusão da documentação de Cebeçalho. Mudanças na utilização de Navigators, como nome nome de arquivos, suas funções e Localização no Projeto (Vide histórico de mudanças de cada arquivo).
 *  - Vinícius Lessa - 23/05/2022: Importação de Fontes Customizadas.
 *  - Vinícius Lessa - 25/05/2022: Implementação do Novo NAVIGATOR Drawer.
 *  - Vinícius Lessa - 05/06/2022: Aidção das Página 'User Profile' e 'Chats'.
 * 
 */

// React Navigation Module
import 'react-native-gesture-handler'; // MUST be the first module Imported

import React from 'react'; // JSX Compilation

// React Navigation Module
import { NavigationContainer } from '@react-navigation/native';
import { createNativeStackNavigator } from '@react-navigation/native-stack';
import { createDrawerNavigator } from '@react-navigation/drawer';

// Views
import { 
  TradePosts ,
  TradePostDetailed ,
  NewTradePost ,  
  Welcome ,
  SignIn ,
  SignUp ,
  UserProfile,
  Chats,
  ChatMessage,
  WhoWeAre,
  HelpScreen, 
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
  const Stack = createNativeStackNavigator();

  // React Navigation - Drawer (https://reactnavigation.org/docs/drawer-navigator/)
  const Drawer = createDrawerNavigator();  

  return (
    <NavigationContainer>      
      <Drawer.Navigator
        drawerContent={ (props) => <SideBar {...props} /> }
        initialRouteName="TradePosts"        
      >        

        {/* Home / Anúncios - Index: 0 */}
        <Drawer.Screen
          name='TradePosts'          
          component={TradePosts}
          options={{            
            headerShown: false ,
            // unmountOnBlur: true,
          }}
        />        

        {/* TradePostDetailed - Index: 1 */}
        <Stack.Screen 
          name="TradePostDetailed" 
          component={TradePostDetailed} 
          options={{
            headerShown: false ,
            unmountOnBlur: true,
            gestureHandlerProps:{
              enabled: false
            }
          }}
        />
        
        {/* <Drawer.Screen
          name='TradePostDetailed'
          component={TradePostDetailed}
          options={{
            headerShown: false ,
            unmountOnBlur: true,
            gestureHandlerProps:{
              enabled: false
            }
          }}
        /> */}

        {/* Criar Post - Index: 2 */}
        <Drawer.Screen
          name='NewTradePost'
          component={NewTradePost}
          options={{
            headerShown: false ,
            unmountOnBlur: true,            
          }}
        />
        
        {/* Music Trade Center - Index: 3 */}
        <Drawer.Screen
          name='MusicTradeCenter'
          component={MusicTradeCenter}
          options={{
            headerShown: false ,            
          }}          
        />

        {/* Feed Musical - Index: 4 */}
        <Drawer.Screen
          name='FeedMusical'
          component={FeedMusical}
          options={{
            headerShown: false ,
          }}
        />

        {/* SignIn - Index: 5 */}
        <Drawer.Screen
          name="SignIn"
          component={SignIn}
          options={{
            headerShown: false ,
            unmountOnBlur: true,
          }}
        />        
        
        {/* SignUp (Antigo 'Create') - Index: 6 */}
        <Drawer.Screen
          name="SignUp"
          component={SignUp}
          options={{
            headerShown: false ,
            unmountOnBlur: true,
          }}
        />

        {/* Bem-Vindo - Index: 7 */}
        <Drawer.Screen
          name="Welcome"
          component={Welcome}
          options={{
            headerShown: false ,
          }}
        />

        {/* UserProfile - Index: 8 */}
        <Drawer.Screen
          name='UserProfile'
          component={UserProfile}          
          options={{            
            headerShown: false ,
            unmountOnBlur: true,
          }}
        />

        {/* Chats - Index: 9 */}
        <Drawer.Screen
          name='Chats'
          component={Chats}          
          options={{            
            headerShown: false ,
            unmountOnBlur: true,
          }}
        />

        {/* Quem Somos - Index: 10 */}
        <Drawer.Screen
          name="WhoWeAre"
          component={WhoWeAre}
          options={{
            drawerLabel: 'Quem Somos',
            headerShown: false ,
          }}
        />

        {/* Ajuda - Index: 11 */}
        <Drawer.Screen
          name="Help"
          component={HelpScreen}
          options={{
            drawerLabel: 'Ajuda',
            headerShown: false ,
          }}
        />

        {/* TradePostDetailed - Index: 12 */}
        <Stack.Screen
          name="ChatMessage"
          component={ChatMessage} 
          options={{
            headerShown: false ,
            unmountOnBlur: true,
            gestureHandlerProps:{
              enabled: false
            }
          }}
        />

      </Drawer.Navigator>      
      
    </NavigationContainer>    
  );
}