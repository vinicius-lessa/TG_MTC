/**
 * File DOC
 * 
 * @Description Página 'UserProfile', que irá exibir informações sobre o Perfil do usuário Logado.
 * @ChangeLog 
 *  - Vinícius Lessa - 05/06/2022: Criação da documentação de Cabeçalho e Mudanças iniciais na estrutura e Estilo da página.
 * 
 */

import React, { useState, useEffect } from 'react';  // JSX Compilation
import { 
    View ,
    Text ,
    SafeAreaView ,
    ScrollView ,
    Image , 
    Alert ,
    TouchableOpacity ,
} from 'react-native'; // Core Components

import HeaderNoDrawer from './components/HeaderNoDrawer';

import { css } from '../assets/css/css.js'; // Style - css

import api from '../services/api'; // API Sauce

import AsyncStorageLib from '@react-native-async-storage/async-storage'; // AsyncStorage

import LoadingIcon from './components/LoadingDefault'; // Loading Component


const UserProfile = ( {route, navigation} ) => {
  
  // console.log(route);

  // Params Recieved (From SideBar.js)    
  const { userId, userName, userProfilePic, userEmail, userPass } = route.params
  

  // TradePost Hooks
  const [errorMessage , setErrorMessage]  = useState(null);
  const [tpInfo       , setTPInfo]        = useState([]);

  // User Data
  // const [userEmail        , setUserEmail]     = useState(null);
  // const [userProfilePic   , setProfilePic]    = useState(null);
  // const [userPass         , setUserPass]      = useState(null);
  // const [userId           , setUserID]        = useState(null);
  // const [userName         , setUserName]      = useState(null);

  // Lista Anúncios
  async function getUserInfo(post_id) {

    let tokenUrl  = '16663056-351e723be15750d1cc90b4fcd' ;    
    let route     = '/trade_posts.php/?token=' + tokenUrl + '&key=' + post_id;    

    // try {
    //   const response = await api.get(route);

    //   let a_Values = response.data;
      
    //   // Doesn't replace
    //   tpInfo.length == 0 && setTPInfo( a_Values );      
      
    // } catch (response) {
    //   setErrorMessage("Erro: " + response.data.msg);
    //   console.log(response);

    // }
  }

  // Similar ao componentDidMount e componentDidUpdate: 
  useEffect( async () => {
    await getUserInfo(userId);
    
    // const userEmailSession      = await AsyncStorageLib.getItem('@MTC:userEmail');
    // const userProfilePicSession = await AsyncStorageLib.getItem('@MTC:userProfilePic');
    // const userPasswordSession   = await AsyncStorageLib.getItem('@MTC:userPassword');
    // const userIDSession         = await AsyncStorageLib.getItem('@MTC:userID');
    // const userNameSession       = await AsyncStorageLib.getItem('@MTC:userName');

    // // console.log( 'Dados - ' + userEmailSession + " - " + userProfilePicSession + ' - ' + userPasswordSession + ' - ' + userIDSession + ' - ' + userNameSession);

    // if ( userEmailSession && userProfilePicSession && userPasswordSession && userIDSession && userNameSession )            
    //   setUserEmail(userEmailSession);
    //   setProfilePic(userProfilePicSession);
    //   setUserPass(userPasswordSession);
    //   setUserID(userIDSession);
    //   setUserName(userNameSession);
  });

  // Loading
  // if (tpInfo.length == 0 && !errorMessage)
  //   return (
  //     <View style={css.container}>
  //       {/* Header With No Drawer */}
  //       <HeaderNoDrawer
  //         title="MINHA CONTA"
  //         navigation={navigation}
  //       />
  //       <LoadingIcon/>
  //     </View>
  //   ) ;

  return (
    <SafeAreaView style={css.container}>
        
        {/* Header With No Drawer */}
        <HeaderNoDrawer
          title="MINHA CONTA"
          navigation={navigation}
        />
        
        <ScrollView>

          {/* Profile View */}
          <View style={ [ css.p_Three ] }>

            {/* User ID */}
            <View style={ [
              css.centerVerticaly,
            ]}>                
              <Text style={ [
                css.textLightgray,
                css.endtHorizontaly,                    
                css.m_OneRight,
                css.size12
              ] }>
                User ID: #{userId}
              </Text>
            </View>

            {/* Profile Image */}            
            <View style={ [ css.m_OneTop, css.centerSelf, css.flexOne ] }>
              <TouchableOpacity
                style={ [ css.endtHorizontaly, css.m_TwoRight ] }
                onPress={()=>Alert.alert("Função em Desenvolvimento!")}
              >
                <Image
                  source={ {uri: userProfilePic } }
                  style={ css.profileImage }
                />
              </TouchableOpacity>
            </View> 

            {/* User Name */}
            <View style={ [
              css.m_TwoTop,
              css.centerVerticaly,
              css.centerChildren
            ]}>
              <Text style={ [
                css.fontGhotic ,
                css.textLightgray ,                
                css.size16
              ] }>
                Bem Vindo
              </Text>
              <Text style={ [
                css.m_OneTop ,
                css.textWhite ,
                css.fontBebas ,
                css.size40
              ] }>
                {userName}                
              </Text>
            </View>         

            {/* User Info */}
            <View style ={ [
              css.centerChildren,
              css.m_OneTop ,
              css.p_TwoY,
            ]}>

              {/* Principais Habilidades */}
              <View style={css.m_ThreeY}>
                <Text style={ [ 
                  css.m_OneBottom,
                  css.size20,
                  css.textRed,
                  css.fontGhotic,
                  css.centerText
                ] }>
                  Principais Habilidades:
                </Text>
                <Text style={ [ 
                  css.size18,
                  css.textWhite,
                  css.fontGhotic,
                  css.centerText
                ] }>
                  Canto, Guitarra Solo, Bateria Básica
                </Text>
              </View>

              {/* Principais Habilidades */}
              <View style={css.m_ThreeY}>
                <Text style={ [ 
                  css.m_OneBottom,
                  css.size20,
                  css.textRed,
                  css.fontGhotic,
                  css.centerText
                ] }>
                  Gêneros Preferidos:
                </Text>
                <Text style={ [ 
                  css.size18,
                  css.textWhite,
                  css.fontGhotic,
                  css.centerText
                ] }>
                  Rock & Roll, Blues, Jazz
                </Text>
              </View>

              {/* Bio */}
              <View style={ [ css.m_ThreeY ] }>                
                <Text style={ [
                  css.m_OneBottom,
                  css.size20,
                  css.textRed,
                  css.fontGhotic,
                  css.centerText
                ] }>
                  Biografia:
                </Text>
                <View style={ [ css.bkGray, css.p_Two, {borderRadius: 5} ] }>
                  <Text style={ [ 
                    css.size18,
                    css.textWhite,
                    css.fontGhotic,
                    css.justifyText
                  ] }>
                    Estou a procura de pessoas do meio musical para firmar meu aprendizado nos instrumentos. Já tenho conhecimentos básicos em instrumentos de corda, como violão e contra baixo.
                  </Text>
                </View>
              </View>

            </View>
          </View>
        </ScrollView>       

    </SafeAreaView>
  );
}

export default UserProfile;