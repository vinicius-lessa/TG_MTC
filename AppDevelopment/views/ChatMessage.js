/**
 * File DOC
 * 
 * @Description Página 'ChatMessage', onde o Usuário poderá trocar mensagens com outro usuário baseado um anúncio criado.
 * @ChangeLog 
 *  - Vinícius Lessa - 08/06/2022: Criação do Arquivo juntamente com sua base estrutural, dando continuidade posteriormente. Início da Estilização e da passagem de Parâmetros da página anterior. 
 * 
 */

import React, { useState, useEffect } from 'react';  // JSX Compilation
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


const ChatMessage = ( {route, navigation} ) => {

    const windowHeight = Dimensions.get('window').height;

    // Params Received (From Chats.js)    
    const { postId, userId, userTwoId } = route.params ;    

    // TradePost Hooks
    const [errorMessage , setErrorMessage]  = useState(null);
    const [tpInfo       , setTPInfo]        = useState([]);

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


    // Send New Message
    async function SendMessage() {

        console.log(messageInput);

        // let tokenUrl  = '16663056-351e723be15750d1cc90b4fcd' ;    
        // let route     = '/trade_posts.php/?token=' + tokenUrl + '&key=' + postId;    

        // try {
        // const response = await api.get(route);

        // let a_Values = response.data;
        
        // // Doesn't replace
        // tpInfo.length == 0 && setTPInfo( a_Values );      
        
        // } catch (response) {
        // setErrorMessage("Erro: " + response.data.msg);
        // console.log(response);

        // }
    }    

    // Similar ao componentDidMount e componentDidUpdate: 
    useEffect( async () => {
        await getTradePostInfo(postId);        

    });

    // Loading
    if (tpInfo.length == 0 && !errorMessage)
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
        
    const userCreator   = tpInfo.data[0].user_name ;
    const photoUrl      = tpInfo.data[0].image_name ;
    const postTitle     = tpInfo.data[0].title ;
    const postCateogory = tpInfo.data[0].pc_desc ;

    return (
        <SafeAreaView style={css.container}>
            <ScrollView>
                <View style = { { height: windowHeight - 25 } }>
                
                    {/* Header With No Drawer */}
                    <HeaderNoDrawer
                        title="CHATS"
                        navigation={navigation}
                    />

                    {/* Log Messages */}      
                    { !!errorMessage &&
                        <View style={ [ css.container, css.centerVerticaly, css.centerChildren ] }>
                            <Text style={ [css.size20, css.textWhite, css.fontBold,  { marginVertical: 20 } ] }>
                                Desculpe, não encontramos o Anúncios Solicitado!
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

                            <View style={ css.hrChatHeader } />

                            {/* Chat Scroll */}
                            <View style ={[                    
                                css.bkChat ,
                                css.m_One ,
                                { flex: 10 }
                            ]}>
                                {/* Messages */}
                                <ScrollView style = { [ {flexDirection: 'column-reverse'} ] }>                        

                                    {/* Self */}
                                    <View style ={[
                                        css.bkBlue ,
                                        css.selfMessageBox ,
                                        css.rowOrientation ,
                                    ]}>
                                        <View style = {[ { width: '90%', height: '100%' } ]}>
                                            <Text style = {[ css.textWhite ]}>Olá, tudo Bem?</Text>
                                        </View>
                                        
                                        {/* Hour / Day */}
                                        <View style = { [ css.endtHorizontaly, { width: '10%', height: '100%', flexDirection: 'column-reverse' } ] }>
                                            <Text style = {[ css.textWhite, css.endtHorizontaly, { fontSize: 9 } ]}>18:41</Text>
                                        </View>
                                    </View>

                                    {/* UserTwo */}
                                    <View style ={[
                                        css.bkGray ,
                                        css.userTwoMessageBox ,
                                        css.rowOrientation ,
                                    ]}>
                                        <View style = {[ { width: '90%', height: '100%' } ]}>
                                            <Text style = {[ css.textWhite, css.fontBold ]}>Vinícius Lessa</Text>
                                            <Text style = {[ css.textWhite ]}>Tudo sim, e você?</Text>
                                        </View>

                                        {/* Hour / Day */}
                                        <View style = { [ css.endtHorizontaly, { width: '10%', height: '100%', flexDirection: 'column-reverse' } ] }>
                                            <Text style = {[ css.textWhite, css.endtHorizontaly, { fontSize: 9 } ]}>18:41</Text>
                                        </View>
                                    </View>

                                </ScrollView>
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
                                        maxLength={35}
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