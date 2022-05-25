# MTC-MobileApp
<Description>

- Frontend EntryPoint: App.js
<!-- - Backend EntryPoint: Controller.js -->

# NODE MODULES (used within the project)    
- expo CLI
    - <desc> Expo is a set of tools built around React Native
    - command: $ npm install -g expo-cli (https://reactnative.dev/docs/environment-setup)

- react Navigation
    - <desc> React Navigation is made up of some core utilities and those are then used by navigators to create the navigation structure in your app.
    - commands:
        Base
        - $ npm install @react-navigation/native (https://reactnavigation.org/docs/getting-started)
        
        Dependencies
        - $ expo install react-native-screens react-native-safe-area-context (https://reactnavigation.org/docs/getting-started)

        Others
        - $ npm install @react-navigation/native-stack (https://reactnavigation.org/docs/hello-react-navigation)
        - $ npm install @react-navigation/drawer (https://reactnavigation.org/docs/drawer-navigator/)
        - $ expo install react-native-gesture-handler react-native-reanimated (https://reactnavigation.org/docs/drawer-navigator/)
            ** Necessário Adicionar plugin no arquivo babel.config.js **

- expo AppLoadging
    - <desc> Utilizado no Root do projeto (App.js) para validar o carregamento das fontes customizadas
    - command: $ expo install expo-app-loading

- API Sauce
    - <desc> ... (TradePost.js)
    - command: $ npm i apisauce --save

- Async Storage
    - <desc> An asynchronous, persistent, key-value storage system for React Native.
    - <doc> Documentation: https://react-native-async-storage.github.io/async-storage/docs/install/
    - <git> Documentation: https://github.com/react-native-async-storage/async-storage    
    - command: $ expo install @react-native-async-storage/async-storage