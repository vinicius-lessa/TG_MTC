/**
 * File DOC
 * 
 * @Description Página considadera 'Home'. Aqui serão exibidos todos os Anúncios presentes no Banco de Dados em forma de Lista.
 * @ChangeLog 
 *  - Vinícius Lessa - 18/05/2022: Mudança do nome do arquivo de 'Home' para 'TradePosts', seguindo padrão WEB. Mudanças estruturais e visuais.
 *  - Vinícius Lessa - 23/05/2022: Continuação da tratative de carregamento das Fonts e Consumo da API (Utilização da API Sauce).
 *  - Vinícius Lessa - 05/06/2022: Ajuste do comprimento dos dados do anúncio (para evitar estouro de layout).
 */

import React, { useState, useEffect } from 'react';  // JSX Compilation
import { 
  Text ,
  View ,
  TouchableOpacity ,
  SafeAreaView ,
  ScrollView ,
} from 'react-native'; // Core Components

import HeaderDefault from './components/Header';

import { css } from '../assets/css/css.js'; // Style - css
import * as Animatable from 'react-native-animatable'; // Animation

import api from '../services/api'; // API Sauce

import AsyncStorageLib from '@react-native-async-storage/async-storage'; // AsyncStorage

import LoadingIcon from './components/LoadingDefault'; // Loading Component


// Trade Post Row Component
const TpRow = (props) => {  
  
  return (
    <View style = {[
      css.tradePostRow ,
      props.rowReverse ? css.rowReverseOrientation : css.rowOrientation ,
      { width: "auto", minWidth: 100, },
    ]}>
      {/* Image */}
      <View style={css.tpImgBox}>
        <Animatable.Image
          animation="flipInY"
          source={ {uri: props.uri } }
          resizeMode = "contain"
          style={ css.imgDefault }
        />
      </View>

      {/* TP Info */}
      <View style={css.tpDescriptionBox}>
        
        {/* TP Title */}
        <Text style={ [css.tradePostTitle, css.fontGhotic ] }>
          { props.title.length < 40 ? props.title : props.title.substring(0, 40) + "..." }
        </Text>

        {/* TP General Info */}
        <View style = { css.tpInfoBox }>
          <Text style={ [ css.size16, css.fontGhotic ] }>
            <Text style={ [ css.textRed ] }>Categoria: </Text>
            <Text style={ [ css.textWhite ] }>              
              { props.cateogory.length < 13 ? props.cateogory : props.cateogory.substring(0, 13) + "..." } 
              </Text>
          </Text>

          <Text style={ [ css.size16, css.fontGhotic ] }>
            <Text style={ [ css.textRed, css.fontGhotic ] }>Por: </Text>
            <Text style={ [ css.textWhite, css.fontGhotic ] }>
              { props.creator.length < 20 ? props.creator : props.creator.substring(0, 20) + "..." }
            </Text>
          </Text>
        </View>
        
        {/* Price + Details */}
        <View style = { [ css.rowOrientation, { marginTop:10 } ]}>
          <View style = { [ css.centerVerticaly, css.centerChildren , { width: '50%' }] }>
            <Text style={ [ css.size18, css.textWhite, css.fontGhotic ]}>R$ {props.price}</Text>
          </View>

          <View style = { [ css.centerVerticaly, css.centerChildren, { width: '50%' } ] }>
            <TouchableOpacity 
              onPress={()=>props.navigation.navigate('TradePostDetailed', {
                postId: props.post_id ,                
              })}
              style={[ 
                css.buttonDefault, { width: '90%' } 
              ]}
            >
              <Text style={ [ css.textWhite, css.size15, css.fontGhotic ] }>Detalhes</Text>
            </TouchableOpacity>
          </View>
        </View>
      </View>
    </View>
  );    
};

const TradePosts = (props) => {

  // TradePost Hooks
  const [errorMessage, setErrorMessage] = useState(null);
  const [tradePostList, setTradePostList] = useState([]);

  // User Data
  const [userEmail        , setUserEmail]     = useState(null);
  const [userProfilePic   , setProfilePic]    = useState(null);
  const [userPass         , setUserPass]      = useState(null);
  const [userId           , setUserID]        = useState(null);
  const [userName         , setUserName]      = useState(null);

  // Iterate
  var counter = 0;
  var lastId  = 0;
  
  // Lista Anúncios
  async function listTradePosts() {

    let tokenUrl  = '16663056-351e723be15750d1cc90b4fcd' ;
    let route    = '/trade_posts.php/?token=' + tokenUrl + '&key=all';
    // let route     = '/trade_posts.php/?token=' + tokenUrl + '&key=224';

    try {
      const response = await api.get(route);

      let a_Values = response.data;
      
      // Doesn't replace
      tradePostList.length == 0 && setTradePostList( a_Values );
      
    } catch (response) {
      if ( response.data.msg ) {
        setErrorMessage("Erro: " + response.data.msg);
      } else {
        setErrorMessage("Erro Inesperado!");
      }        

    }
  }

  // Similar ao componentDidMount e componentDidUpdate: 
  useEffect( async () => {
    await listTradePosts();
    
    const userEmailSession      = await AsyncStorageLib.getItem('@MTC:userEmail');
    const userProfilePicSession = await AsyncStorageLib.getItem('@MTC:userProfilePic');
    const userPasswordSession   = await AsyncStorageLib.getItem('@MTC:userPassword');
    const userIDSession         = await AsyncStorageLib.getItem('@MTC:userID');
    const userNameSession       = await AsyncStorageLib.getItem('@MTC:userName');

    // console.log( 'TradePosts.js' + userEmailSession + " - " + userProfilePicSession + ' - ' + userPasswordSession + ' - ' + userIDSession + ' - ' + userNameSession);

    if ( userEmailSession && userProfilePicSession && userPasswordSession && userIDSession && userNameSession )            
      setUserEmail(userEmailSession);
      setProfilePic(userProfilePicSession);
      setUserPass(userPasswordSession);
      setUserID(userIDSession);
      setUserName(userNameSession);
  });

  // Loading
  if (tradePostList.length == 0 && !errorMessage)
    return (
      <View style={css.container}>
        <HeaderDefault 
          title="Anúncios"          
          userName={userName}
          userPhotoURL={userProfilePic}
          userEmail={userEmail}  
          userPass={userPass}
          userId={userId}
          hideRightIcon={true}
          navigation={props.navigation}
        />
        <LoadingIcon/>
      </View>
    ) ;

  // Just Like 'Render' method
  return (
    <View style={css.container}>
            
      {/* Header */}
      <HeaderDefault 
        title="Anúncios"          
        userName={userName}
        userPhotoURL={userProfilePic}
        userEmail={userEmail}  
        userPass={userPass}
        userId={userId}
        hideRightIcon={false}
        navigation={props.navigation}
      />

      {/* Log Messages */}      
      { !!errorMessage &&
        <View style={ [ css.container, css.centerVerticaly, css.centerChildren ] }>
          <Text style={ [css.size20, css.textWhite, css.fontBold,  { marginVertical: 20 } ] }>
            Desculpe, não conseguimos nos Conectar!
          </Text>
          <Text style={ [css.size22, css.textWhite, { marginVertical: 20 } ] }>
            ¯\_(ツ)_/¯
          </Text>
          <Text style={ [css.size18, css.textRed, css.fontBold,  { marginVertical: 20 } ] }>
            { errorMessage }
          </Text>
        </View>
      }

      {/* Trade Posts List */}
      { !errorMessage && 
        <SafeAreaView style={ [ css.flexOne, css.m_ThreeTop ] }>
          <ScrollView>

            {
              tradePostList.data.map(function(tpRow) {
                // Pula Repetidos (por imagem)
                if (lastId == tpRow.post_id)
                  return null;

                //check if the number is Even or Odd
                var isEven = (counter % 2 == 0 ? true : false);

                counter++;
                lastId = tpRow.post_id;              

                return (
                  <View key={lastId.toString()}>
                    <TpRow
                      post_id={tpRow.post_id}
                      title={tpRow.title}
                      description={tpRow.tp_desc}
                      cateogory={tpRow.pc_desc}
                      creator={tpRow.user_name}                    
                      price={tpRow.price}
                      uri={tpRow.image_name}
                      rowReverse={ isEven ? false : true }
                      navigation={props.navigation}
                    />

                    <View style={ css.hrDefault } />

                  </View>
                );                            
              })
            }            

            {/* Horizontal Line */}
            {/* <View style={ css.hrDefault } /> */}        
          </ScrollView>
        </SafeAreaView> 
      }     

    </View>  
  );
}

export default TradePosts;