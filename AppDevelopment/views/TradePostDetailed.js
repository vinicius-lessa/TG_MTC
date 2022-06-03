/**
 * File DOC
 * 
 * @Description Página 'TradePostDetailed', que irá exibir os detalhes de determinado anúncio com base no ID recebido.
 * @ChangeLog 
 *  - Vinícius Lessa - 02/06/2022: Criação da documentação de Cabeçalho e Mudanças iniciais na estrutura e Estilo da página.
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


const TradePostDetailed = ( {route, navigation} ) => {
  
  // console.log(route);

  // Params Recieved (From TradePost.js)
  const { cateogory, creator, description, post_id, price, title, uri } = route.params;

  // TradePost Hooks
  const [errorMessage , setErrorMessage]  = useState(null);
  const [tpInfo       , setTPInfo]        = useState([]);

  // User Data
  const [userEmail        , setUserEmail]     = useState(null);
  const [userProfilePic   , setProfilePic]    = useState(null);
  const [userPass         , setUserPass]      = useState(null);
  const [userId           , setUserID]        = useState(null);
  const [userName         , setUserName]      = useState(null);

  // Lista Anúncios
  async function getTradePostInfo(post_id) {

    let tokenUrl  = '16663056-351e723be15750d1cc90b4fcd' ;    
    let route     = '/trade_posts.php/?token=' + tokenUrl + '&key=' + post_id;    

    try {
      const response = await api.get(route);

      let a_Values = response.data;
      
      // Doesn't replace
      tpInfo.length == 0 && setTPInfo( a_Values );

      console.log(tpInfo.data[0]);
      
    } catch (response) {
      setErrorMessage("Erro: " + response.data.msg);

    }
  }

  // Similar ao componentDidMount e componentDidUpdate: 
  useEffect( async () => {
    await getTradePostInfo(post_id);
    
    const userEmailSession      = await AsyncStorageLib.getItem('@MTC:userEmail');
    const userProfilePicSession = await AsyncStorageLib.getItem('@MTC:userProfilePic');
    const userPasswordSession   = await AsyncStorageLib.getItem('@MTC:userPassword');
    const userIDSession         = await AsyncStorageLib.getItem('@MTC:userID');
    const userNameSession       = await AsyncStorageLib.getItem('@MTC:userName');

    // console.log( 'Dados - ' + userEmailSession + " - " + userProfilePicSession + ' - ' + userPasswordSession + ' - ' + userIDSession + ' - ' + userNameSession);

    if ( userEmailSession && userProfilePicSession && userPasswordSession && userIDSession && userNameSession )            
      setUserEmail(userEmailSession);
      setProfilePic(userProfilePicSession);
      setUserPass(userPasswordSession);
      setUserID(userIDSession);
      setUserName(userNameSession);
  });

  // Loading
  if (tpInfo.length == 0 && !errorMessage)
    return (
      <View style={css.container}>
        {/* Header With No Drawer */}
        <HeaderNoDrawer
          title="DETALHES"
          userName={creator}
          userPhotoURL={null}
          navigation={navigation}
        />
        <LoadingIcon/>
      </View>
    ) ;

  return (
    <SafeAreaView style={css.container}>
        
        {/* Header With No Drawer */}
        <HeaderNoDrawer
          title="DETALHES"
          userName={creator}
          userPhotoURL={null}
          navigation={navigation}
        />
        
        <ScrollView>

          {/* Main Post */}
          <View style={ [ css.p_Three ] }>

            {/* Post Title */}
            <View style={ [
              css.centerVerticaly,
            ]}>
                <Text style={ [
                    css.textWhite ,
                    css.fontBebas ,
                    css.size35
                ] }>
                    {title}
                    {/* {tpInfo.data[0].title} */}
                </Text>
                <Text style={ [
                      css.textLightgray,
                      css.endtHorizontaly,
                      css.m_TwoTop,
                      css.size12
                  ] }>
                  Post #{post_id}
                </Text>
            </View>

            {/* Images */}
            <View style={ [
              css.imgDetailedRow ,
              css.centerVerticaly,
              css.m_ThreeTop
            ]}>
              <TouchableOpacity
                onPress={()=>Alert.alert("Função em Desenvolvimento!")}
              >
                <Image
                  source={ {uri: tpInfo.data[0].image_name } }
                  resizeMode = "contain"
                  style={ [ {
                    width: 300, height: 300
                  }] }
                />
                
              </TouchableOpacity>
            </View>

            {/* Trade Post Detailed */}
            <View style ={ [
              css.centerChildren,
              css.m_ThreeTop ,
              css.p_TwoY,
            ]}>

              {/* Category */}
              <View style={css.m_ThreeY}>
                <Text style={ [ 
                  css.size20,
                  css.textRed,
                  css.fontGhotic,
                  css.centerText
                ] }>
                  Categoria:
                </Text>

                <Text style={ [
                  css.size18, 
                  css.textWhite,
                  css.fontGhotic,
                  css.centerText
                ] }>
                  {cateogory}
                </Text>
              </View>

              {/* Brand */}
              <View style={css.m_ThreeY}>
                <Text style={ [                  
                  css.size20,
                  css.textRed,
                  css.fontGhotic,
                  css.centerText
                ] }>
                  Marca:
                </Text>

                <Text style={ [
                  css.size18, 
                  css.textWhite,
                  css.fontGhotic,
                  css.centerText
                ] }>
                  {tpInfo.data[0].pb_desc}
                </Text>
              </View>
              
              {/* Model */}
              <View style={css.m_ThreeY}>
                <Text style={ [                  
                  css.size20,
                  css.textRed,
                  css.fontGhotic,
                  css.centerText
                ] }>
                  Model:
                </Text>

                <Text style={ [
                  css.size18,
                  css.textWhite,
                  css.fontGhotic,
                  css.centerText
                ] }>
                  {tpInfo.data[0].pm_desc}
                </Text>
              </View>              

              {/* Description */}
              <View style={css.m_ThreeY}>
                <Text style={ [                   
                  css.size20,
                  css.textRed,
                  css.fontGhotic,
                  css.centerText
                ] }>
                  Descrição:
                </Text>

                <Text style={ [
                  css.size18, 
                  css.textWhite,
                  css.fontGhotic,
                  css.centerText
                ] }>
                  {tpInfo.data[0].tp_desc}
                </Text>              
              </View>

                  
            </View>

            {/* Other Info */}
            <View style={[ css.p_ThreeY ]}>
              <Text style={[ css.size30, css.textWhite, css.fontGhotic, css.centerText ]}>
                R$ {price}
              </Text>

              <TouchableOpacity
                  style={[
                    css.m_ThreeTop,
                    css.buttonWelcome, 
                    css.centerChildren, 
                    css.centerSelf
                  ]}
                  onPress={() => Alert.alert("Função em Desenvolvimento")}
              >
                <Text style={[
                  css.size26,
                  css.textWhite, 
                  css.fontBebas,
                ]}>
                  Negociar
                </Text>
              </TouchableOpacity>

            </View>
          </View>
        </ScrollView>

    </SafeAreaView>
  );
}

export default TradePostDetailed;