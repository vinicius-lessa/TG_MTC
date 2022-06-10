/**
 * File DOC
 * 
 * @Description Página 'Chats', que irá exibir todas as Conversas do usuário Logado, permitindo-o selecionar uma delas.
 * @ChangeLog 
 *  - Vinícius Lessa - 05/06/2022: Criação da documentação de Cabeçalho e Mudanças iniciais na estrutura e Estilo da página.
 *  - Vinícius Lessa - 06/06/2022: Início da criação da página em si, realizando requisições via GET ao Backend baseado no userId.
 *  - Vinícius Lessa - 08/06/2022: Finalização da página na parte Lógica, onde já está realizando a requisição GET dos chats o qual o usuário participa, além da estilização.
 * 
 */

import React, { useState, useEffect } from 'react';  // JSX Compilation
import { 
  View ,
  Text ,
  SafeAreaView ,
  ScrollView ,
  Image ,
  TouchableOpacity, 
  Alert,
} from 'react-native'; // Core Components

import HeaderNoDrawer from './components/HeaderNoDrawer.js';

import api from '../services/api'; // API Sauce

import LoadingIcon from './components/LoadingDefault'; // Loading Component

import { css } from '../assets/css/css.js'; // Style - css


const ChatRow = (props) => {  

  // Message Text Logic
  let sender        = "";  
  let lastMessage   = props.message;

  let messageConcat = "";
  
  // Rementente
  sender = props.isSameUser ? "Você" : props.nameUserLastMessage;  

  messageConcat = sender + ": " + lastMessage
    if (messageConcat.length > 30)
      lastMessage = lastMessage.substring(0, 22) + "..." ;

  // Message Date/Time Logic
  let currentDate = new Date().getTime();
  let messageDate = new Date(props.hour.replace(" ", "T"));

  let dayDifference = (currentDate - messageDate.getTime()) / (1000 * 3600 * 24)  
  
  // const yyyy = messageDate.getFullYear();
  let mm = messageDate.getMonth() + 1; // Months start at 0!
  let dd = messageDate.getDate();

  if (dd < 10) dd = '0' + dd;
  if (mm < 10) mm = '0' + mm;  

  let messageTimeLabel = 
    dayDifference >= 1 ?
    dd + '/' + mm : // Outro dia
    messageDate.getHours() - 3 + ":" + messageDate.getMinutes(); // Hoje

  return (
    <View>
      <View style = {[
        css.chatListRow
      ]}>
        {/* Chat Info */}
        <View style={css.chatListDescBox}>
          <View style = { [ css.flexTwo ] }>
            <TouchableOpacity
              // onPress={() => Alert.alert("Função em Desenvolvimento!")}
              onPress={()=>props.navigation.navigate('ChatMessage', {
                userId: props.userId ,
                userTwoId: props.userTwoId ,
                postId: props.postId ,                
              })}
            >
              {/* Chat Title */}
              <Text style = {[
                css.textRed ,
                css.fontBold ,
                css.size14,
              ]}>
                {props.title} <Text style={[ css.size12, css.fontNormal ]}>({props.userTwoName})</Text>
              </Text>
            </TouchableOpacity>
          </View>

          {/* Message */}
          <View style = { [ css.flexOne, css.rowOrientation, css.p_TwoRight ] }>
            <View style = { [ css.centerSelf, { width: '90%' } ] }>
              <Text style = {[ css.textWhite, css.size12 ]}>
                <Text style = { css.fontBold }>{sender}: </Text>{lastMessage}
              </Text>
            </View>

            {/* Hour / Day */}
            <View style = { [ css.centerSelf, css.m_TwoRight, { width: '10%' } ] }>
              <Text style = {[ css.textWhite, { fontSize: 9 } ]}>{messageTimeLabel}</Text>
            </View>
          </View>
        </View>

        {/* Image */}
        <View style={css.chatListImgBox}>
          <TouchableOpacity 
            onPress={()=>props.navigation.jumpTo('TradePostDetailed', {
              postId: props.postId ,
            })}
          >
            <Image
              source={ {uri: props.photoUrl} }
              style={ css.profileImageChatList }
            />
            {/* <Image
              source={ {uri: props.photoUrl} }
              resizeMode = 'contain'
              style={ css.imgDefault }
            /> */}
          </TouchableOpacity>          
        </View>
      </View>

      {/* { !props.isLastRow && <View style={ css.hrChatList } /> } */}
    </View>
  );
}

const Chats = ( {route, navigation} ) => {  // Could recieve "props" instead of "{navigation}"

  // const lastScreen = navigation.getState().history[1];

  // Params Received
  const { userId, userName, userProfilePic, userEmail, userPass } = route.params ;

  // TradePost Hooks
  const [errorMessage , setErrorMessage]  = useState(null);
  const [noChatMessage, setNoChat]        = useState(null);
  const [chatList     , setChatList]      = useState([]);
  
  // Iterate
  const [countChatRows , setCountChatRows] = useState(0);  
  var countSelfTp   = 0;
  var countOthersTp = 0;
  var lastId        = 0;

  // Lista Anúncios
  async function listChats() {

    let tokenUrl  = '16663056-351e723be15750d1cc90b4fcd' ;
    let route    = '/chat.php/?token=' + tokenUrl + '&userLogged=' + userId + '&key=chatList';

    try {
      const response = await api.get(route);

      let a_Values = response.data;
      
      // Doesn't replace
      chatList.length == 0 && setChatList( a_Values );            

      if (chatList.error)
        setNoChat(chatList.msg);
      
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
    await listChats();
        
  });  

  // Loading
  if ( (chatList.length == 0 && !errorMessage) || (chatList.error && noChatMessage === null) ) {
    return (
      <View style={css.container}>
        {/* Header With No Drawer */}
        <HeaderNoDrawer
          title="CHATS"
          navigation={navigation}
        />

        <LoadingIcon/>
      </View>
    ) ;
  }  

  return (    
    <SafeAreaView style={css.container}>
        
      {/* Header With No Drawer */}
      <HeaderNoDrawer
        title="CHATS"
        navigation={navigation}
      />

      {/* Log Messages */}      
      { !!errorMessage ?
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
      :
      <View style={ css.flexOne }>

        { 
          !!noChatMessage ?

          <View style={ [ css.container, css.centerVerticaly, css.centerChildren ] }>
            <Text style={ [css.size20, css.textWhite, css.fontBold,  { marginVertical: 20 } ] }>
              Você ainda não possui Nenhum Chat
            </Text>
            <Text style={ [css.size22, css.textWhite, { marginVertical: 20 } ] }>
              ¯\_(ツ)_/¯
            </Text>
            <Text style={ [css.size18, css.textRed, css.fontBold,  { marginVertical: 20 } ] }>
              { noChatMessage }
            </Text>
          </View>
        :
          <View style={ css.flexOne }>
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
                  
                  {
                    chatList.data.map(function(chatRow) {
                      // Pula Repetidos (por imagem)
                      if (lastId == chatRow.chat_id)
                        return null;

                      countSelfTp++;

                      lastId = chatRow.chat_id;

                      if ( chatRow.userid_tp_creator == userId ) {
                        
                        return (
                          <View key={Math.floor(Math.random() * 100000).toString()}>
                            <ChatRow
                              userId={userId}
                              userTwoId={chatRow.userTwo}
                              userTwoName={chatRow.userTwo_Name}
                              postId={chatRow.post_id}
                              // photoUrl={chatRow.image_name}
                              photoUrl={chatRow.userTwo_Image}
                              isLastRow={false}
                              isSameUser={chatRow.userid_tp_creator == userId}
                              nameUserLastMessage={chatRow.username_lastmessage}
                              section={1} // 1 = Seus Anúncios - 2 = Seus Interesses
                              title={chatRow.post_title}                              
                              message={chatRow.last_message}
                              hour={chatRow.message_date}
                              navigation={navigation}
                            />
                          </View>
                        );
                      } else {
                        return null;
                      }
                    })
                  }                                                       
                  
                  {/* Chat List Row - No Functional Example */}                  
                  {/* <ChatRow
                    postId={304}
                    isLastRow={false}
                    isSameUser={true}
                    section={1} // 1 = Seus Anúncios - 2 = Seus Interesses
                    title={'Bateria Shelter STD82'}
                    author={'José Guilherme'}
                    message={'Tudo sim e Você ??'}
                    hour={'2022-05-29 21:16:15'}
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
                    hour={'2022-04-18 10:20:40'}
                    photoUrl={'https://musictradecenter.000webhostapp.com/BackendDevelopment/uploads/imagem-2022-05-13_8748.jpg'}
                    navigation={navigation}
                  /> */}

                </ScrollView>

                {
                  countSelfTp == 0 &&
                  <View style = { [css.flexTwo] }>
                    <Text style = { [ css.textWhite, css.size16, css.centerSelf ] }>
                      Nenhuma Proposta Recebida!
                    </Text>
                  </View>
                }
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
                  {
                    chatList.data.map(function(chatRow) {
                      // Pula Repetidos (por imagem)
                      if (lastId == chatRow.post_id)
                        return null;                      

                      // setCountChatRows(countChatRows + 1);                      
                      countOthersTp++;

                      lastId = chatRow.post_id;

                      if ( chatRow.userid_tp_creator != userId ) {
                        return (
                          <View key={Math.floor(Math.random() * 100000).toString()}>
                            <ChatRow
                              userId={userId}
                              userTwoId={chatRow.userTwo}
                              userTwoName={chatRow.userTwo_Name}
                              postId={chatRow.post_id}
                              // photoUrl={chatRow.image_name}
                              photoUrl={chatRow.userTwo_Image}
                              isLastRow={false}
                              isSameUser={chatRow.userid_tp_creator == userId}
                              nameUserLastMessage={chatRow.username_lastmessage}
                              section={2} // 1 = Seus Anúncios - 2 = Seus Interesses
                              title={chatRow.post_title}
                              author={chatRow.username_tp_creator}
                              message={chatRow.last_message}
                              hour={chatRow.message_date}                              
                              navigation={navigation}
                            />                            
    
                          </View>
                        );
                      } else {
                        return null;
                      }
                    })
                  }

                  {/* Chat List Row */}
                  {/* <ChatRow 
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
                  />*/}

                </ScrollView>

                {
                  countOthersTp == 0 &&
                  <View style = { [css.flexTwo] }>
                    <Text style = { [ css.textWhite, css.size16, css.centerSelf ] }>
                      Nenhuma Conversa Iniciada!
                    </Text>
                  </View>
                }
              </View>
            </View>
          </View>
        }
        
      </View>
      }      
      

    </SafeAreaView>
  );
}

export default Chats;