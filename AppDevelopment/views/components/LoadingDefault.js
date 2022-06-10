/**
 * File DOC
 * 
 * @Description Página 'Music Trade Center', Mostrando o perfil de outros usuários da Plataforma.
 * @ChangeLog 
 *  - Vinícius Lessa - 02/06/2022: Criação do Arquivo e documentação de Cabeçalho. Cópia da estrutura utilizada localmente nos arquivos.
 *  - Vinícius Lessa - 09/06/2022: Adição da prop "textOpt" que pode adicionar um texto abaixo do icone de carregamento.
 * 
 */

import React from 'react';  // JSX Compilation
import { 
    View ,
    ActivityIndicator ,
    Text ,
} from 'react-native'; // Core Components

import { css } from '../../assets/css/css.js'; // Style - css 

// Loading Component
const LoadingIcon = (props) => {

    return (
      <View style={css.container}>
        <View style = { [ css.flexOne, css.rowOrientation, css.centerChildren ] }>
          <View style = { [ css.centerSelf, css.widthAuto ] }>
            <ActivityIndicator size="large" color="#eb1f36" style = { [ css.centerSelf ] } />
            { 
              !!props.textOpt && 
              <View style = { [ css.centerSelf, css.m_TwoTop ] }>
                <Text style={ [ css.textRed, css.size14 ] }>{props.textOpt}</Text>
              </View>
            }
          </View>
        </View>
      </View>
    );
};

export default LoadingIcon;