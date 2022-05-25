/**
 * File DOC
 * 
 * @Description Página considadera 'Home'. Aqui serão exibidos todos os Anúncios presentes no Banco de Dados em forma de Lista.
 * @ChangeLog 
 *  - Vinícius Lessa - 18/05/2022: Mudança do nome do arquivo de 'Home' para 'TradePosts', seguindo padrão WEB. Mudanças estruturais e visuais.
 *  - Vinícius Lessa - 23/05/2022: Continuação da tratative de carregamento das Fonts e Consumo da API (Utilização da API Sauce).
 * 
 */

import React, { useState, useEffect } from 'react';  // JSX Compilation
import { 
  Text,
  View,
  TouchableOpacity,
  SafeAreaView,
  ScrollView,  
  ActivityIndicator,
  Alert 
} from 'react-native'; // Core Components

import HeaderDefault from './components/Header';

import api from '../services/api'; // API Sauce

import { css } from '../assets/css/css.js'; // Style - css

import * as Animatable from 'react-native-animatable'; // Animation

import AsyncStorageLib from '@react-native-async-storage/async-storage'; // AsyncStorage

// Loading Component
const LoadingIcon = () => {
  return (
    <View style={css.container}>
      <View style = { [ css.flexOne, css.rowOrientation, css.centerChildren ] }>
        <View style = { [ css.centerSelf, css.widthAuto ] }>
          <ActivityIndicator size="large" color="#eb1f36" style = { [ css.centerSelf ] } />
        </View>
      </View>
    </View>
  );
};

// Trade Post Row Component
const TpRow = (props) => {
  return (
    <View style = {[
      css.tradePostRow ,
      props.rowReverse ? css.rowReverseOrientation : css.rowOrientation ,
      { width: "auto", minWidth: 100, },
    ]}
    >
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
        <Text style={ [css.tradePostTitle, css.fontGhotic ] }>{props.title}</Text>

        {/* TP General Info */}
        <View style = { css.tpInfoBox }>
          <Text style={ [ css.size16, css.fontGhotic ] }>
            <Text style={ [ css.colorRed ] }>Categoria: </Text>
            <Text style={ [ css.colorWhite ] }>{props.cateogory}</Text>
          </Text>

          <Text style={ [ css.size16, css.fontGhotic ] }>
            <Text style={ [ css.colorRed, css.fontGhotic ] }>Por: </Text>
            <Text style={ [ css.colorWhite, css.fontGhotic ] }>{props.creator}</Text>
          </Text>          
        </View>
        
        {/* Price + Details */}
        <View style = { [ css.rowOrientation, { marginTop:10 } ]}>
          <View style = { [ css.centerVerticaly, css.centerChildren , { width: '50%' }] }>
            <Text style={ [ css.size18, css.colorWhite, css.fontGhotic ]}>R$ {props.price}</Text>
          </View>
                      
          <View style = { [ css.centerVerticaly, css.centerChildren, { width: '50%' } ] }>
            <TouchableOpacity style={ [ css.buttonDefault, { width: '90%' } ] }>
              <Text style={ [ css.colorWhite, css.size15, css.fontGhotic ] }>Detalhes</Text>
            </TouchableOpacity>
          </View>
        </View>
      </View>
    </View>
  );    
};

const TradePosts = (props) => {
  
  // SignIn Hooks
  const [errorMessage, setErrorMessage] = useState(null);
  const [loggedInUser, setLoggedInUser] = useState(null);
  const [tradePostList, setTradePostList] = useState([]);  

  // Iterate
  var counter = 0;
  var lastId  = 0;  

  const pageTitle = "Anúncios";  
  
  // Lista Anúncios
  async function listTradePosts() {    

    let tokenUrl  = '16663056-351e723be15750d1cc90b4fcd' ;
    let route    = '/trade_posts.php/?token=' + tokenUrl + '&key=all';
    // let route     = '/trade_posts.php/?token=' + tokenUrl + '&key=224';

    try {
      const response = await api.get(route);      

      let a_Values = response.data;
      
      tradePostList.length == 0 && setTradePostList( a_Values );
      
    } catch (response) {
      setErrorMessage(response.data.msg);

    }
  }  

  // SignIn
  async function signIn() {
    let tokenUrl = '16663056-351e723be15750d1cc90b4fcd' ;
    let route  = "/users.php/?token=" + tokenUrl + "&key=SignIn";

    try {
      const response = await api.post(route, {
        email: 'vinicius.lessa33@gmail.com' ,
        password: '123456' ,
      });

      const { user, token } = response.data ;

      await AsyncStorageLib.multiSet([
        ['@MTC:token', token],
        ['@MTC:userName', JSON.stringify(user)],
      ]);

      setLoggedInUser(JSON.stringify(user)); //State

      Alert.Alert("Login Realizado com Sucesso!");
      // Continuar de: https://youtu.be/fBrOtR3pgPU - 25:35      

    } catch(response) {
      setErrorMessage("Erro: " + response.data.msg);

    }

    // response.headers
    // response.ok 
    //  true/false - http +400 = false
    
  }

  // Similar ao componentDidMount e componentDidUpdate: 
  useEffect( async () => {        
    await listTradePosts();

    const token     = await AsyncStorageLib.getItem('@MTC:token');
    const userName  = await AsyncStorageLib.getItem('@MTC:userName');

    if ( token && userName )
      loggedInUser = userName;    
  });

  // Loading
  if (tradePostList.length == 0 && !errorMessage)
    return (
      <View style={css.container}>
        <HeaderDefault 
          title="Anúncios"
          isLoggedUser={false}
          userName={null}
          userPhotoURL={null}
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
        isLoggedUser={false}
        userName={null}
        userPhotoURL={null}
        navigation={props.navigation}
      />

      {/* Messages */}      
      { !!errorMessage && 
        <View style={ [ css.container, css.centerVerticaly, css.centerChildren ] }>
          <Text style={ [css.size20, css.colorWhite, css.fontBold,  { marginVertical: 20 } ] }>
            Desculpe, não conseguimos no Conectar!
          </Text>
          <Text style={ [css.size22, css.colorWhite, { marginVertical: 20 } ] }>
            ¯\_(ツ)_/¯
          </Text>
          <Text style={ [css.size18, css.colorRed, css.fontBold,  { marginVertical: 20 } ] }>
            { errorMessage }
          </Text>
        </View>
      }
      {/* { !!loggedInUser && <Text>{ loggedInUser }</Text> } */}

      {/* Trade Posts List */}
      { !errorMessage && 
        <SafeAreaView style={ {
          flex: 1,
          paddingTop: 10,
        } }>
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
                      cateogory={tpRow.pc_desc}
                      creator={tpRow.user_name}                    
                      price={tpRow.price}
                      uri={tpRow.image_name}
                      rowReverse={ isEven ? false : true }
                    />

                    <View style={ css.hrDefault } />

                  </View>
                );                            
              })
            }

            {/* Non Functional Examples */}          
            {/* <TpRow 
              title='Bateria Mapex Vermelha'
              cateogory='Baterias'
              brand='Mapex'
              condition='Boas Condições'
              price='2500,00'
              uri='https://musictradecenter.000webhostapp.com/BackendDevelopment/uploads/imagem-2022-05-16_5235.png'
              rowReverse={false}
            /> */}

            {/* Horizontal Line */}
            {/* <View style={ css.hrDefault } /> */}        
          </ScrollView>
        </SafeAreaView> 
      }     

    </View>  
  );
}

export default TradePosts;