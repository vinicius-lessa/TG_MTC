/**
 * File DOC
 * 
 * @Description Página 'ChatMessage', onde o Usuário poderá trocar mensagens com outro usuário baseado um anúncio criado.
 * @ChangeLog 
 *  - Vinícius Lessa - 08/06/2022: Criação do Arquivo juntamente com sua base estrutural, dando continuidade posteriormente.
 * 
 */

import React from 'react';  // JSX Compilation
import { 
    View ,
    Text ,
    SafeAreaView
} from 'react-native'; // Core Components

import HeaderNoDrawer from './components/HeaderNoDrawer.js';

import api from '../services/api'; // API Sauce

import LoadingIcon from './components/LoadingDefault'; // Loading Component

import { css } from '../assets/css/css.js'; // Style - css


const ChatMessage = (props) => {

    return (
        <SafeAreaView style={css.container}>
            
            {/* Header With No Drawer */}
            <HeaderNoDrawer
                title="CHATS"
                navigation={props.navigation}
            />
            
            <View style={ [ css.flexOne, css.centerVerticaly ]}>
                <Text style={ [
                    css.titleText ,
                    css.fontBebas
                ] }>
                    MENSAGEM
                </Text>
            </View>

        </SafeAreaView>
    );
}

export default ChatMessage;