/**
 * File DOC
 * 
 * @Description Componente da Navegação Lateral do APP.
 * @ChangeLog 
 *  - Vinícius Lessa - 26/05/2022: Criação do Arquivo e documentação de Cabeçalho. Início da Estilização.
 *  - Vinícius Lessa - 28/05/2022: Continuação da implementação dos estilos e funcionalidades, como de Sign-out.
 *  - Vinícius Lessa - 35/05/2022: Finzalização do processo de naveção após SignIn/SignOut (CustomActions.reset).
 */

import React, { useState, useEffect } from 'react';  // JSX Compilation
import {   
    View ,
    Text ,    
    ScrollView ,
    TouchableOpacity ,
    Image ,
    ActivityIndicator, 
    Alert,
} from 'react-native'; // Core Components

import { CommonActions } from '@react-navigation/native'; // React Navigation

import { css } from '../../assets/css/css.js'; // Style - css

import {
    DrawerContentScrollView,
    DrawerItemList,
    DrawerItem,
} from '@react-navigation/drawer';

// Icons
import { Ionicons } from '@expo/vector-icons';
import { AntDesign } from '@expo/vector-icons';
import { FontAwesome } from '@expo/vector-icons'; 

import AsyncStorageLib from '@react-native-async-storage/async-storage'; // AsyncStorage


// Loading Component
const LoadingIcon = () => {
    return (
      <View style={ [ css.container, css.p_TwoY, { backgroundColor: '#dadada' } ] }>
        <View style = { [ css.flexOne, css.rowOrientation, css.centerChildren ] }>
          <View style = { [ css.centerSelf, css.widthAuto ] }>
            <ActivityIndicator size="large" color="#eb1f36" style = { [ css.centerSelf ] } />
          </View>
        </View>
      </View>
    );
};

const ProfileSection = (props) => {            

    // Loagado
    if (props.isLoggedUser) {

        return(
            <View style={ [ css.p_OneY ] }>                                
                
                <View style={ [ css.rowOrientation ] }>                    

                    {/* Profile Pic */}
                    <View style={ [ css.centerSelf, css.flexOne, { left: 11 } ] }>
                        <TouchableOpacity style={ [ css.endtHorizontaly, css.m_TwoRight ] }>
                            <Image
                                source={ {uri: props.userPhotoURL } }
                                style={ css.profileImageSideBar }
                            />
                        </TouchableOpacity>                    
                    </View>

                    {/* User Name */}
                    <View style={ [ css.centerSelf, css.flexOne, { left: 11 } ] }>
                        <Text style={ [ css.textGray, css.size14 ] }>Bem Vindo</Text>
                        <Text style={ [ css.textRed, css.size22, css.fontBebas ] }>{props.userName}</Text>
                    </View>                    

                    {/* Logout Button */}
                    <View>
                        <TouchableOpacity 
                            style={ [ css.endtHorizontaly ] }
                            onPress={ () => props.signOutUser() }
                        >                        
                            <FontAwesome name="sign-out" size={24} color="black" style={ [ css.endtHorizontaly, css.m_TwoRight, css.m_OneTop ] } />
                        </TouchableOpacity>
                    </View>                                    
                </View>

            </View>            
        );
    } else {

        return(
            <View style={ [ css.rowOrientation ] }>
                <View style={ [ css.centerSelf, css.flexOne ] }>
                    <Ionicons style={ [ css.endtHorizontaly ] } name="person-circle-sharp" size={100} color="#eb1f36" />
                </View>
                <View style={ [ css.centerSelf, css.flexOne ] }>
                    <TouchableOpacity onPress={()=>props.navigation.navigate('Entrar')}>
                        <Text style = { [css.size24, css.textRed] }>ENTRAR</Text>
                    </TouchableOpacity>
                </View>
            </View>  
        );
    }
}

const SideBar = (props) => {    

    // User Data
    const [userEmail        , setUserEmail]     = useState(null);
    const [userProfilePic   , setProfilePic]    = useState(null);
    const [userPass         , setUserPass]      = useState(null);
    const [userId           , setUserID]        = useState(null);
    const [userName         , setUserName]      = useState(null);

    const [isLoading        , setIsLoading]     = useState(false);

    // Sing-Out Function
    async function signOutUser() {

        setIsLoading(true);
    
        const keys = [
            '@MTC:userEmail' , 
            '@MTC:userProfilePic' ,
            '@MTC:userPassword' ,
            '@MTC:userID' ,
            '@MTC:userName'
        ]
        
        try {
            await AsyncStorageLib.multiRemove(keys)
            
            console.log("Sign-Out com sucesso!!!")

            setIsLoading(false);

            return props.navigation.dispatch(
                CommonActions.reset({
                    index: 0, // Entrar
                    routes: [
                        { name: 'SignIn' },
                    ],
                })
            );

        } catch(e) {
            // error
            console.log(e);

        } 
    }

    // Similar ao componentDidMount e componentDidUpdate: 
    useEffect( async () => {       

        const userEmailSession      = await AsyncStorageLib.getItem('@MTC:userEmail');
        const userProfilePicSession = await AsyncStorageLib.getItem('@MTC:userProfilePic');
        const userPasswordSession   = await AsyncStorageLib.getItem('@MTC:userPassword');
        const userIDSession         = await AsyncStorageLib.getItem('@MTC:userID');
        const userNameSession       = await AsyncStorageLib.getItem('@MTC:userName');

        if ( userEmailSession && userProfilePicSession && userPasswordSession && userIDSession && userNameSession )            
            setUserEmail(userEmailSession);
            setProfilePic(userProfilePicSession);
            setUserPass(userPasswordSession);
            setUserID(userIDSession);
            setUserName(userNameSession);
    });

    // Booleans
    const isLoggedUser   = !!userName;

    var currentPageIndex = props.navigation.getState().index;

    return (
        <ScrollView style={ [ { backgroundColor: '#dadada' } ] }>
            <DrawerContentScrollView>

                <ProfileSection
                    userName={userName}
                    userPhotoURL={userProfilePic}                    
                    isLoggedUser={isLoggedUser}
                    navigation={props.navigation}
                    signOutUser={signOutUser}
                />

                {isLoading && <LoadingIcon />}

                <View style={ [css.hrDefault, css.m_TwoX ] } />
                
                <View style={ [ {paddingHorizontal: 10} ] }>
                    <View style={css.rowOrientation}>
                        <Text style = { [css.size24, css.textBlack, css.fontBebas, css.m_ThreeLeft, css.m_ThreeY] }>Navegação</Text>
                        <AntDesign name="down" size={20} color="black" style={{ top: 18, left: 10 }} />
                    </View>

                    {/* Trade Posts */}
                    <DrawerItem
                        label="Anúncios"
                        focused={ currentPageIndex == 0 && true }
                        onPress={() => props.navigation.navigate('TradePosts')}
                        labelStyle={ [ 
                            css.size20, css.fontGhotic
                        ] }                        
                        inactiveTintColor='#575757'
                        activeTintColor='#eb1f36'
                    />

                    {/* New Trade Post */}
                    <DrawerItem
                        label="Novo Anúncio"
                        focused={ currentPageIndex == 2 && true }
                        onPress={() => props.navigation.navigate('NewTradePost')}
                        labelStyle={ [ 
                            css.size20, css.fontGhotic
                        ] }
                        inactiveTintColor='#575757'
                        activeTintColor='#eb1f36'
                    />

                    {/* Music Trade Center */}
                    <DrawerItem
                        label="Music Trade Center"
                        focused={ currentPageIndex == 3 && true }
                        onPress={() => props.navigation.navigate('MusicTradeCenter')}
                        labelStyle={ [ 
                            css.size20, css.fontGhotic
                        ] }
                        inactiveTintColor='#575757'
                        activeTintColor='#eb1f36'
                    />
                    
                    {/* Feed Musical */}
                    <DrawerItem
                        label="Feed Musical"
                        focused={ currentPageIndex == 4 && true }
                        onPress={() => props.navigation.navigate('FeedMusical')}
                        labelStyle={ [ 
                            css.size20, css.fontGhotic
                        ] }
                        inactiveTintColor='#575757'
                        activeTintColor='#eb1f36'
                    />

                    {/* SignIn */}
                    <DrawerItem
                        label="Login"
                        focused={ currentPageIndex == 5 && true }
                        onPress={() => props.navigation.navigate('SignIn')}
                        labelStyle={ [ 
                            css.size20, css.fontGhotic
                        ] }
                        inactiveTintColor='#575757'
                        activeTintColor='#eb1f36'
                    />

                    {/* SignUp */}
                    <DrawerItem
                        label="Cadastrar"
                        focused={ currentPageIndex == 6 && true }
                        onPress={() => props.navigation.navigate('SignUp')}
                        labelStyle={ [ 
                            css.size20, css.fontGhotic
                        ] }
                        inactiveTintColor='#575757'
                        activeTintColor='#eb1f36'
                    />

                    <View style={ css.hrDefault } />

                    {/* Who We Are */}
                    <DrawerItem
                        label="Sobre"
                        focused={ currentPageIndex == 8 && true }
                        onPress={() => props.navigation.navigate('WhoWeAre')}
                        labelStyle={ [ 
                            css.size20, css.fontGhotic
                        ] }
                        inactiveTintColor='#575757'
                        activeTintColor='#eb1f36'
                    />                    

                    {/* Help */}
                    <DrawerItem
                        label="Ajuda"
                        focused={ currentPageIndex == 9 && true }
                        onPress={() => props.navigation.navigate('Help')}
                        labelStyle={ [ 
                            css.size20, css.fontGhotic
                        ] }
                        inactiveTintColor='#575757'
                        activeTintColor='#eb1f36'
                    />

                    {/* <DrawerItemList
                        {...props}
                    /> */}
                </View>
                
            </DrawerContentScrollView>
        </ScrollView>
    );
}

export default SideBar;