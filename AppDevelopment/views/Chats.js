/**
 * File DOC
 * 
 * @Description Página 'Chats', que irá exibir todas as Conversas do usuário Logado, permitindo-o selecionar uma delas.
 * @ChangeLog 
 *  - Vinícius Lessa - 05/06/2022: Criação da documentação de Cabeçalho e Mudanças iniciais na estrutura e Estilo da página.
 *  - Vinícius Lessa - 06/06/2022: Início da criação da página em si, realizando requisições via GET ao Backend baseado no userId.
 */

import React from 'react';  // JSX Compilation
import { 
  View ,
  Text ,
  SafeAreaView ,
  ScrollView ,
  Image ,
  TouchableOpacity ,
} from 'react-native'; // Core Components

import HeaderNoDrawer from './components/HeaderNoDrawer.js';

import { css } from '../assets/css/css.js'; // Style - css


const ChatRow = (props) => {
  
  return (
    <View>
      <View style = {[
        css.chatListRow
      ]}>
        {/* Chat Info */}
        <View style={css.chatListDescBox}>

          <View style = { [ css.flexTwo ] }>
            {/* Chat Title */}
            <Text style = {[
              css.textWhite ,
              css.fontBold ,
              css.size14,
            ]}>
              {props.title} <Text style={[ css.size12, css.fontNormal ]}>({props.author})</Text>
            </Text>
          </View>

          {/* Message */}
          <View style = { [ css.flexOne, css.rowOrientation, css.p_TwoRight ] }>
            <View style = { [ css.centerSelf, { width: '90%' } ] }>
              <Text style = {[ css.textWhite, css.size12 ]}>
                { props.isSameUser && <Text style = { css.fontBold }>Você: </Text> }{props.message}
              </Text>
            </View>

            <View style = { [ css.centerSelf, css.m_TwoRight, { width: '10%' } ] }>
              <Text style = {[ css.textWhite, { fontSize: 9 } ]}>  {props.hour}</Text>
            </View>
          </View>

        </View>

        {/* Image */}
        <View style={css.chatListImgBox}>
          <TouchableOpacity 
            onPress={()=>props.navigation.navigate('TradePostDetailed', {
              post_id: props.postId ,
            })}            
          >
            <Image
              source={ {uri: props.photoUrl} }
              resizeMode = 'contain'                  
              style={ css.imgDefault }
            />
          </TouchableOpacity>          
        </View>                           
      </View>

      { !props.isLastRow && <View style={ css.hrChatList } /> }
    </View>
  );
}

const Chats = ( {route, navigation} ) => {  // Could recieve "props" instead of "{navigation}"

  // Params Received
  const { userId, userName, userProfilePic, userEmail, userPass } = route.params

  return (
    <SafeAreaView style={css.container}>
        
      {/* Header With No Drawer */}
      <HeaderNoDrawer
        title="CHATS"
        navigation={navigation}
      />
      
      {/* SEUS ANÚNCIOS */}
      <View style={[ css.flexOne, css.centerVerticaly ]}>
        <View style = {[
          css.flexOne ,
          css.m_TwoY
        ]}>
          <Text style={ [
              css.titleText ,
              css.fontBebas ,              
          ] }>
            SEUS ANÚNCIOS
          </Text>
        </View>

        <View style= {[
          css.chatList ,
          { flex: 5 }
        ]}>
          <ScrollView>
            
            {/* Chat List Row */}
            <ChatRow
              postId={304}
              isLastRow={false}
              isSameUser={false}
              section={1} // 1 = Seus Anúncios - 2 = Seus Interesses
              title={'Amplificador Borne Vorax 1050'}
              author={'Renata Carrillo'}
              message={'Olá, tudo bem contigo amigo?'}
              hour={'18:21'}
              photoUrl={'https://musictradecenter.000webhostapp.com/BackendDevelopment/uploads/imagem-2022-05-13_3384.jpg'}
              navigation={navigation}
            />
            <ChatRow
              postId={304}
              isLastRow={false}
              isSameUser={true}
              section={1} // 1 = Seus Anúncios - 2 = Seus Interesses
              title={'Bateria Shelter STD82'}
              author={'José Guilherme'}
              message={'Tudo sim e Você ??'}
              hour={'11:40'}
              photoUrl={'https://musictradecenter.000webhostapp.com/BackendDevelopment/uploads/imagem-2022-05-13_9408.jpg'}
              navigation={navigation}
            />
            <ChatRow
              postId={304}
              isLastRow={true}
              isSameUser={true}
              section={1} // 1 = Seus Anúncios - 2 = Seus Interesses
              title={'Contrabaixo Condor XB25A'}
              author={'Vinicius Lessa'}
              message={'Faço por no mínimo R$ 1100,00'}
              hour={'11:40'}
              photoUrl={'https://musictradecenter.000webhostapp.com/BackendDevelopment/uploads/imagem-2022-05-13_8748.jpg'}
              navigation={navigation}
            />

          </ScrollView>
        </View>
      </View>

      {/* SEUS INTERESSES */}
      <View style={[ css.flexOne, css.centerVerticaly ]}>
        <View style = {[
          css.flexOne ,
          css.m_TwoY
        ]}>
          <Text style={ [
              css.titleText ,
              css.fontBebas ,              
          ] }>
            SEUS INTERESSES
          </Text>
        </View>

        <View style= {[
          css.chatList ,
          { flex: 5 }
        ]}>
          <ScrollView>

            {/* Chat List Row */}
            <ChatRow 
              postId={304}
              isLastRow={false}
              isSameUser={false}
              section={1} // 1 = Seus Anúncios - 2 = Seus Interesses
              title={'Amplificador Borne Vorax 1050'}
              author={'Renata Carrillo'}
              message={'Olá, tudo bem contigo amigo?'}
              hour={'18:21'}
              photoUrl={'https://musictradecenter.000webhostapp.com/BackendDevelopment/uploads/imagem-2022-05-13_3384.jpg'}
              navigation={navigation}
            />
            <ChatRow
              postId={304}
              isLastRow={false}
              isSameUser={true}
              section={1} // 1 = Seus Anúncios - 2 = Seus Interesses
              title={'Bateria Shelter STD82'}
              author={'José Guilherme'}
              message={'Tudo sim e Você ??'}
              hour={'11:40'}
              photoUrl={'https://musictradecenter.000webhostapp.com/BackendDevelopment/uploads/imagem-2022-05-13_9408.jpg'}
              navigation={navigation}
            />
            <ChatRow
              postId={304}
              isLastRow={true}
              isSameUser={true}
              section={1} // 1 = Seus Anúncios - 2 = Seus Interesses
              title={'Contrabaixo Condor XB25A'}
              author={'Vinicius Lessa'}
              message={'Faço por no mínimo R$ 1100,00'}
              hour={'11:40'}
              photoUrl={'https://musictradecenter.000webhostapp.com/BackendDevelopment/uploads/imagem-2022-05-13_8748.jpg'}
              navigation={navigation}
            />

          </ScrollView>
        </View>
      </View>

    </SafeAreaView>
  );
}

export default Chats;