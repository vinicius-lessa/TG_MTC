/**
 * File DOC
 * 
 * @Description Página 'ChatMessage', onde o Usuário poderá trocar mensagens com outro usuário baseado um anúncio criado.
 * @ChangeLog 
 *  - Vinícius Lessa - 08/06/2022: Criação do Arquivo juntamente com sua base estrutural, dando continuidade posteriormente. Início da Estilização e da passagem de Parâmetros da página anterior. 
 *  - Vinícius Lessa - 09/06/2022: Continuação da parte Funcional da screen de mensagens, primeiramente lendo o chat atual, e depois permitindo o envio de mensagens.
 *  - Vinícius Lessa - 22/06/2022: Implementação do Envio de mensagens via APP, antes somente realizada a leitura das mensagens. Utilizado método POST (assim como na WEB).
 * 
 */

import React, { useState, useEffect, useRef } from 'react';  // JSX Compilation
import { 
    View ,
    Text ,
    SafeAreaView ,
    ScrollView ,
    Image ,
    TextInput ,
    TouchableOpacity ,
} from 'react-native'; // Core Components

import { css } from '../assets/css/css.js'; // Style - css

import HeaderNoDrawer from './components/HeaderNoDrawer.js';

import api from '../services/api'; // API Sauce

import LoadingIcon from './components/LoadingDefault'; // Loading Component

import { FontAwesome } from '@expo/vector-icons'; // Icons

import { Dimensions } from 'react-native'; // Dimensions


const ChatMessageRow = (props) => {
      
    // Message Date/Time Logic
    let currentDate = new Date().getTime();
    let messageDate = new Date(props.messageDate.replace(" ", "T"));    

    let dayDifference = (currentDate - messageDate.getTime()) / (1000 * 3600 * 24)

    // console.log(new Date());

    // const yyyy = messageDate.getFullYear();
    let mm = messageDate.getMonth() + 1; // Months start at 0!
    let dd = messageDate.getDate();

    if (dd < 10) dd = '0' + dd;
    if (mm < 10) mm = '0' + mm;

    let messageTimeLabel =
        dayDifference >= 1 ?
        dd + '/' + mm : // Outro dia
        messageDate.getHours() - 3 + ":" + messageDate.getMinutes(); // Hoje

    {/* Self Message */}
    if ( props.isSelf ) {
        return(
            <View>                
                <View style ={[
                    css.bkBlue ,
                    css.selfMessageBox ,
                    css.rowOrientation ,
                ]}>
                    <View style = {[ { width: '90%', height: '100%' } ]}>
                        <Text style = {[ css.textWhite ]}>{props.message}</Text>
                    </View>
                    
                    {/* Hour / Day */}
                    <View style = { [ css.endtHorizontaly, { width: '10%', height: '100%', flexDirection: 'column-reverse' } ] }>
                        <Text style = {[ css.textWhite, css.endtHorizontaly, { fontSize: 9 } ]}>{messageTimeLabel}</Text>
                    </View>
                </View>                    
            </View>
    
        );
    {/* UserTwo message*/}
    } else {
        return(
            <View>                    
                <View style ={[
                    css.bkGray ,
                    css.userTwoMessageBox ,
                    css.rowOrientation ,
                ]}>
                    <View style = {[ { width: '90%', height: '100%' } ]}>
                        <Text style = {[ css.textWhite, css.fontBold ]}>{props.name}</Text>
                        <Text style = {[ css.textWhite ]}>{props.message}</Text>
                    </View>
    
                    {/* Hour / Day */}
                    <View style = { [ css.endtHorizontaly, { width: '10%', height: '100%', flexDirection: 'column-reverse' } ] }>
                        <Text style = {[ css.textWhite, css.endtHorizontaly, { fontSize: 9 } ]}>{messageTimeLabel}</Text>
                    </View>
                </View>
            </View>
    
        );
    }    
}

const ChatMessage = ( {route, navigation} ) => {

    const scrollRef = useRef()

    const windowHeight = Dimensions.get('window').height;    

    // Params Received (From Chats.js)    
    const { postId, userId, userTwoId } = route.params ;    

    // Chat Hooks
    const [errorMessage , setErrorMessage]  = useState(null);
    const [tpInfo       , setTPInfo]        = useState([]);
    const [chatStory    , setChatStory]     = useState([]);    
    const [arrChatStory , setArrChat]       = useState([]);

    const [requestServer , setRequestServ]  = useState(true); // Does the Refresh Server? Default: Yes
    

    // Input
    const [messageInput    , setMessageInput] = useState(null);

    // Get TradePost Info
    async function getTradePostInfo(postId) {

        let tokenUrl  = '16663056-351e723be15750d1cc90b4fcd' ;    
        let route     = '/trade_posts.php/?token=' + tokenUrl + '&key=' + postId;

        try {
            const response = await api.get(route);

            let a_Values = response.data;
            
            // Doesn't replace
            tpInfo.length == 0 && setTPInfo( a_Values );      
        
        } catch (response) {
            setErrorMessage("Erro: " + response.data.msg);
            console.log(response);

        }
    }
    
    // Refresh Chat
    async function refreshChat(){        

        let tokenUrl  = '16663056-351e723be15750d1cc90b4fcd' ;    
        let route     = '/chat.php/?token=' + tokenUrl + '&userLogged=' + userId + '&userTwo=' + userTwoId + '&post_id=' + postId + '&key=refreshChat';

        try {
            const response = await api.get(route);

            const a_Values = Array.from(response.data.data).reverse();
                        
            chatStory.length === 0 && setChatStory( a_Values );
        
        } catch (response) {
            if ( !!response.data.msg ) {
                setErrorMessage("Erro: " + response.data.msg);
            } else {
                setErrorMessage("Erro Inesperado! ");
            }
            console.log(response);

        }
    }

    // Send New Message
    async function SendMessage() {

        let message = messageInput;
        
        if ( !messageInput ) {
            console.log("Nenhuma Mensagem a ser Enviada.");
            return null;
        }

        setMessageInput(""); // CLear Input
        setRequestServ(false); // Pauses Chat Refresh

        let aUsers = [userId, userTwoId];
        
        let tokenUrl  = '16663056-351e723be15750d1cc90b4fcd';
        let route     = '/chat.php/';
        
        let aData = {
            token: tokenUrl,
            users: aUsers,
            post_id: postId,
            newMessage: message,
        }

        try {
            const response = await api.post(route, 
                { 
                    token: tokenUrl,
                    users: aUsers,
                    post_id: postId,
                    newMessage: message,
                } ,
                { headers: { 'Content-Type': 'multipart/form-data' } } 
            );

            // console.log(response.data);

            if ( !response.data.error ) {
                setTimeout(() => {
                    setRequestServ(true);
                    refreshChat();
                }, 3000); // Allow Refresh Chat
            }

        } catch(response) {
            setTimeout(() => {
                setErrorMessage("Erro: " + response.data.msg);

                console.log(response.data);

                setRequestServ(true); // Allow Refresh Chat
            }, 3000);
        }                
    }    

    // Similar ao componentDidMount e componentDidUpdate: 
    useEffect( () => {

        // Anything in here is fired on component mount.
        getTradePostInfo(postId);
     
        const interval = setInterval(() => {
            if (requestServer){
                console.log("Refreshing Messages...");
                refreshChat();
            } else {
                console.log("Refresh Disabled...");                
            }
        }, 7000);

        return () => {
            // Anything in here is fired on component unmount.
            clearInterval(interval);
        }
    }, []);

    // Loading
    if (tpInfo.length == 0 && !errorMessage) {
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

    const userCreator   = tpInfo.data[0].user_name ;
    const photoUrl      = tpInfo.data[0].image_name ;
    const postTitle     = tpInfo.data[0].title ;
    const postCateogory = tpInfo.data[0].pc_desc ;             
    
    // console.log(chatStory);

    return (
        <SafeAreaView style={css.container}>
            
            {/* Header With No Drawer */}
            <HeaderNoDrawer
                title="CHATS"
                navigation={navigation}
            />

            <ScrollView>
                <View style = { { height: windowHeight - 90 } }>                                    

                    {/* Log Messages */}      
                    { !!errorMessage &&
                        <View style={ [ css.container, css.centerVerticaly, css.centerChildren ] }>
                            <Text style={ [css.size20, css.textWhite, css.fontBold,  { marginVertical: 20 } ] }>
                                Desculpe, Tivemos um problema no Chat!
                            </Text>
                            
                            <Text style={ [css.size22, css.textWhite, { marginVertical: 20 } ] }>¯\_(ツ)_/¯</Text>
                            
                            <Text style={ [css.size18, css.textRed, css.fontBold,  { marginVertical: 20 } ] }>
                                { errorMessage }
                            </Text>
                        </View>
                    }

                    {/* Chat */}
                    { !errorMessage && 
                    
                        <View style={ [ 
                            css.flexOne, 
                            css.centerVerticaly ,
                            css.chatMessageBox ,
                        ]}>
                            {/* Chat Header */}
                            <View style ={[
                                css.flexTwo ,                    
                                css.m_One ,
                                css.centerChildren ,
                                css.rowOrientation ,
                            ]}>
                                {/* Image */}
                                <View style={css.chatImgBox}>
                                    <Image
                                        source={ {uri: photoUrl } }
                                        resizeMode = 'contain'
                                        style={ css.imgDefault }
                                    />
                                </View>

                                {/* TP Info */}
                                <View style={css.chatDescriptionBox}>
                                    
                                    {/* TP Title */}
                                    <View style={[
                                        css.flexTwo ,                            
                                    ]}>
                                        <Text style={[
                                            css.textWhite ,
                                            css.size18 ,
                                            css.fontGhotic ,
                                        ]}>
                                            { postTitle.length < 23 ? postTitle : postTitle.substring(0, 23) + "..." }
                                        </Text>
                                    </View>

                                    {/* TP General Info */}
                                    <View style={[
                                        css.flexOne ,                            
                                    ]}>
                                        <Text style={[
                                            css.size14,
                                            css.fontGhotic 
                                        ]}>
                                            <Text style={ [ css.textRed ] }>Categoria: </Text>
                                            <Text style={ [ css.textWhite ] }>              
                                            { postCateogory.length < 19 ? postCateogory : postCateogory.substring(0, 19) + "..." } 
                                            </Text>
                                        </Text>
                                    </View>

                                    <View style={[
                                        css.flexOne ,                            
                                    ]}>
                                        <Text style={[
                                            css.size14,
                                            css.fontGhotic 
                                        ]}>
                                            <Text style={ [ css.textRed, css.fontGhotic ] }>Por: </Text>
                                            <Text style={ [ css.textWhite, css.fontGhotic ] }>
                                            { userCreator.length < 20 ? userCreator : userCreator.substring(0, 20) + "..." }
                                            </Text>
                                        </Text>
                                    </View>
                                </View>
                            </View>                            

                            {/* Chat Scroll */}
                            <View style ={[                    
                                css.bkChat ,
                                css.m_One ,
                                css.p_One ,
                                { flex: 10 }
                            ]}>
                                {/* Messages */}                                

                                {
                                    chatStory.length == 0
                                    ?
                                    <View style = { [ css.flexOne, css.bkChat ] }>
                                        <LoadingIcon
                                            textOpt={'Carregando Mensagens'}
                                        />
                                    </View>
                                    :
                                    <ScrollView
                                        ref={scrollRef}
                                        onContentSizeChange= {() => scrollRef.current.scrollToEnd({animated: true})}
                                    >
                                        {
                                            chatStory.map(function(chatMessage) {
                                                return (
                                                    <View key={chatMessage.created_on.toString()}>                                                        
                                                        <ChatMessageRow
                                                            name={chatMessage.user_name}
                                                            message={chatMessage.message}
                                                            messageDate={chatMessage.created_on}
                                                            isSelf={chatMessage.message_user_id == userId}
                                                        />
                                                    </View>
                                                );                                                
                                            })
                                        } 

                                            {/* No Functional Examples */}
                                            {/* 
                                            <View>
                                                <ChatMessageRow 
                                                    name={'Renata Carrillo'}
                                                    message={'Tudo bem, e você? Tem interesse no item??'}                                        
                                                    messageDate={'2022-06-09 10:20:28'}
                                                    isSelf={4 == userId}
                                                />

                                                <ChatMessageRow 
                                                    name={'Vinícius Lessa'}
                                                    message={'Olá, como Vai?'}
                                                    messageDate={'2022-06-08 18:29:28'}
                                                    isSelf={14 == userId}
                                                /> 
                                            </View>
                                            */} 
                                            { !requestServer && <LoadingIcon/> }
                                    </ScrollView>
                                }

                                
                            </View>

                            {/* Chat Input */}
                            <View style ={[
                                css.flexOne ,                        
                                css.m_One ,
                                css.rowOrientation ,
                            ]}>
                                <View style ={[                            
                                    { width: '88%', height: '100%' }
                                ]}>
                                    <TextInput
                                        placeholder="Menssagem..."
                                        maxLength={60}
                                        value={messageInput}
                                        style={[
                                            css.inputChatMessage ,                                    
                                        ]}
                                        onChangeText={text=>setMessageInput(text)}
                                    />
                                </View>

                                {/* Button */}
                                <View style ={[                            
                                    css.centerVerticaly ,
                                    { width: '12%', height: '100%' }
                                ]}>
                                    <TouchableOpacity
                                        style={ [ css.centerSelf ] }
                                        onPress={()=>SendMessage()}
                                    >
                                        <FontAwesome name="send" size={20} color="#eb1f36" />
                                    </TouchableOpacity>
                                </View>

                            </View>
                        </View>
                    }                
                </View>
            </ScrollView>

        </SafeAreaView>
    );
}

export default ChatMessage;